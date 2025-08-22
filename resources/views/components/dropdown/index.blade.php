<div x-data="{ open: false }" class="relative">
    <div @click="open = !open">
        {{ $trigger }}
    </div>
    <div x-cloak x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="absolute right-0 mt-2 w-fit bg-white rounded-md shadow-lg z-10 py-2 shadow border border-gray-200">

        {{ $slot }}
    </div>
</div>
