<table {{ $attributes->merge(['class' => 'min-w-full table-auto border border-neutral-700 rounded-lg overflow-hidden text-sm']) }}>
    <thead class="bg-neutral-800 text-left text-neutral-300 uppercase text-xs">
    {{ $head }}
    </thead>
    <tbody class="divide-y divide-neutral-700 text-neutral-100">
    {{ $body }}
    </tbody>
</table>
