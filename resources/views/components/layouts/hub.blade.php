@php use App\Models\Sponsor; @endphp
<x-layouts.app>
    <div class="flex">
        <div class="flex-col lg:w-72 flex inset-y-0 relative min-h-screen bg-hw-dark">
            <div
                class="pb-4 px-6 overflow-y-auto flex-col grow flex">
                <nav class="flex flex-col flex-1">
                    <div class="flex flex-col flex-1 justify-between mt-2 -mx-2">
                        <!-- Top section -->
                        <ul class="mt-2 -mx-2" role="list">
                            {{-- Home link --}}
                            <x-hw.sidebar-link
                                :type="'link'"
                                :label="'Home'"
                                :route="'dashboard'"
                                :icon="'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25'"/>
                            @can('viewAny', Sponsor::class)
                                <x-hw.sidebar-link
                                    :type="'link'"
                                    :label="'Sponsors'"
                                    :route="'sponsors.index'"
                                    :icon="'M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z'"/>
                            @endcan
                        </ul>

                        <!-- Bottom section -->
                        <!-- TODO: Remove the pb-12 at some point -->
                        <ul class="flex flex-col pb-12" role="list">
                            <li>
                                <div class="leading-6 font-semibold text-xs text-gray-400 hidden lg:block">Profile</div>
                                <ul class="mt-2 -mx-2" role="list">
                                    <x-hw.sidebar-link
                                        :type="'link'"
                                        :label="'Edit profile'"
                                        :route="'dashboard'"
                                        :icon="'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z'"
                                        :roleColour="Auth::user()->role_colour"/>
                                    <x-hw.sidebar-link
                                        :type="'form'"
                                        :label="'Logout'"
                                        :route="'logout'"
                                        :icon="'M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75'"
                                        :roleColour="Auth::user()->role_colour"></x-hw.sidebar-link>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Content -->
        <div class="grow overflow-y-auto bg-hw-dark px-2">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>
