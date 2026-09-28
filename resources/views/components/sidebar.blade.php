@php
    $links = [
        ['label' => 'Carrinho', 'route' => 'sales.index', 'icon' => 'ShoppingCart'],
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'House'],
        ['label' => 'Produtos', 'route' => 'products.index', 'icon' => 'ShoppingBag'],
        ['label' => 'Categorias', 'route' => 'categories.index', 'icon' => 'Tags'],
        ['label' => 'Estoque', 'route' => 'stock.index', 'icon' => 'Package'],
        ['label' => 'Usuários', 'route' => 'users.index', 'icon' => 'Users'],
    ]
@endphp

<aside id="sidebar" class="sidebar" aria-label="Menu principal">

    <div class="sidebar__brand">

        <span class="sidebar__logo">GM</span>

        <div class="sidebar__text">
            <strong>Glamour Make</strong>
            <small>Gestão de Estoque</small>
        </div>
    </div>

    

        
    
    <nav class="sidebar__nav">

        @foreach ($links as $link)

            @php($isActive = request()->routeIs($link['route']))

            <a
                class="sidebar__link {{ $isActive ? 'sidebar__link--active' : '' }}"
                href="{{ Route::has($link['route']) ? route($link['route']) : '#' }}"
            >
                <span class="sidebar__icon">
                    <i data-lucide="{{ $link['icon'] }}"></i>
                </span>

                <span class="sidebar__text">
                    {{ $link['label'] }}
                </span>
            </a>

        @endforeach

    </nav>

</aside>