<a {{ $attributes->merge([
    'class' => 'block px-6 py-2 text-gray-800 hover:bg-gray-100 whitespace-nowrap',
]) }}>
    {{ $slot }}
</a>
