<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\Yaml\Yaml;

/**
 * Designed by Daan de Waard (@dwaard)
 * https://github.com/HZ-HBO-ICT/it-conference/pull/411/files
 */
class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes the permissions';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $config = $this->readPermissionConfig();

        $this->syncRoles($config['roles']);
        $this->syncPermissions($config['permissions']);

        $this->info('Successful synchronization.');
    }

    /**
     * Reads the config file and parses it into a specific associative array.
     *
     * @return array{
     *     roles: array<int, string>,
     *     permissions: array<string, array<string, array<int, string>>>
     * }
     *
     * @throws Exception
     */
    private function readPermissionConfig(): array
    {
        $config = Yaml::parseFile('config/permissions/permissions.yml');

        if (!isset($config['roles'])) {
            throw new Exception('Error: there are no roles specified!');
        }
        if (!isset($config['permissions'])) {
            throw new Exception('Error: there are no permissions specified!');
        }

        return $config;
    }

    /**
     * Synchronizes all the role data
     *
     * @param  array<int, string>  $input
     * @return void
     */
    private function syncRoles(array $input)
    {
        $role_data = $this->prepareRoles($input);

        foreach ($role_data as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }

        // Delete the roles that are not in the config
        $names_array = array_map(fn ($item) => $item['name'], $role_data);
        Role::whereNotIn('name', $names_array)->delete();
    }

    /**
     * Prepares the roles. It allows for declaring a role as a single item or
     * with attributes. It converts it into a structure:
     * ```
     * [
     *     'name' => $name
     * ]
     * ```
     *
     * @param  array<int, string>  $roles
     * @return array<int, array{name: string}>
     */
    private function prepareRoles(array $roles)
    {
        return array_map(
            fn ($role) => ['name' => $role],
            $roles
        );
    }

    /**
     * Synchronizes the permissions.
     *
     * @param  array<string, array<string, array<int, string>>>  $permissions
     * @return void
     */
    private function syncPermissions(array $permissions)
    {
        $permissions = $this->convertPermissionList($permissions);
        foreach ($permissions as $item) {
            $roles = $item['roles'];
            unset($item['roles']);
            $permission = Permission::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
            try {
                $permission->syncRoles($roles);
            } catch (RoleDoesNotExist $exception) {
                $this->error($exception->getMessage());
            }
        }
        // Delete the permissions that are not in the config
        $names_array = array_map(fn ($item) => $item['name'], $permissions);
        Permission::whereNotIn('name', $names_array)->delete();
    }

    /**
     * Converts the original list of atomic and nested permissions into one
     * list, which is structured as:
     * ```
     * [
     *     'name' => $permission_name,
     *     'roles' => $array_of_role_names
     * ]
     * ```
     *
     * @param  array<string, array<string, array<int, string>>>  $permissions
     * @return array<int, array{
     *      name: string,
     *      roles: array<int, string>
     *  }>
     */
    private function convertPermissionList(array $permissions): array
    {
        $result = [];
        foreach ($permissions as $key => $content) {
            if ($this->isNested($content)) {
                if ($this->hasPermissionAttributes($content)) {
                    $content['name'] = $key;
                    $result[] = $content;
                }
                foreach ($content as $nested_key => $nested_content) {
                    if ($this->hasPermissionAttributes($nested_content)) {
                        // The naming convention for nested permissions is set here
                        // @phpstan-ignore-next-line
                        $nested_content['name'] = "$nested_key $key";
                        $result[] = $nested_content;
                    } else {
                        $result[] = [
                            // The naming convention for nested permissions is ALSO set here
                            'name' => "$nested_key $key",
                            'roles' => $nested_content,
                        ];
                    }
                }
            } else {
                $result[] = [
                    'name' => $key,
                    'roles' => $content,
                ];
            }
        }

        // @phpstan-ignore-next-line
        return $result;
    }

    /**
     * Checks if the given input appears to have permission attributes like
     * `guard_name` and `roles`.
     *
     * @param  array<int, string>|array<string, array<int, string>>|string  $input
     */
    private function hasPermissionAttributes(array|string $input): bool
    {
        if (! is_array($input)) {
            return false;
        }

        // If the nested content holds the keys 'guard_name' or 'roles'
        // it is assumed to be an atomic permission with a guard_name or roles specified as attributes
        return array_key_exists('guard_name', $input) || array_key_exists('roles', $input);
    }

    /**
     * Checks if the given permission content is a nested permission.
     *
     * @param  array<string, mixed>|array<int, mixed>|string  $content
     */
    private function isNested(array|string $content): bool
    {
        if (! is_array($content)) {
            return false;
        }

        // Use the `array_is_list()` function that checks if the array keys are 0, 1, ...
        // So, if the content is just an array, it assumes it is an atomic permission
        return ! array_is_list($content);
    }
}
