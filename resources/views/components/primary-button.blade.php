<button {{ $attributes->merge(['type' => 'submit', 'class' => 'padding: 0.6rem 1.2rem background: #da5767 border: 2px solid #da5767 background-color: #df8c96 border-color: #df8c96 transition: .3s']) }}>
    {{ $slot }}
</button>