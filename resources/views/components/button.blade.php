<button {{ $attributes->merge(['class' => 'btn ' . ($type === 'danger' ? 'btn-danger' : 'btn-primary')]) }}>
    {{ $slot }}
</button>
