@php
    $links = [
        ['label' => 'Carrinho', 'route' => 'sales.index', 'icon' => '🛒'],
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => '🏠'],
        ['label' => 'Produtos', 'route' => 'products.index', 'icon' => '💄'],
        ['label' => 'Categorias', 'route' => 'categories.index', 'icon' => '🪞'],
        ['label' => 'Estoque', 'route' => 'stock.index', 'icon' => '📦'],
        ['label' => 'Usuários', 'route' => 'users.index', 'icon' => '🧑🏾‍🦱'],
    ]
@endphp

<aside id="sidebar" class="sidebar" aria-label="Menu principal">

    <div class="sidebar__brand flex justify-between">

        <span class="sidebar__logo">GM</span>

        <div class="sidebar__text">
            <strong>Glamour Make</strong>
            <small>Gestão de Estoque</small>
        </div>
    </div>

        <div id="hamburguer" >
            <button
                id="sidebarToggle"
                type="button"
                class="rounded-lg p-2"
            >
                ☰
            </button>
        </div>
    
    <nav class="sidebar__nav">

        @foreach ($links as $link)

            @php($isActive = request()->routeIs($link['route']))

            <a
                class="sidebar__link {{ $isActive ? 'sidebar__link--active' : '' }}"
                href="{{ Route::has($link['route']) ? route($link['route']) : '#' }}"
            >
                <span class="sidebar__icon">
                    {{ $link['icon'] }}
                </span>

                <span class="sidebar__text">
                    {{ $link['label'] }}
                </span>
            </a>

        @endforeach

    </nav>

</aside>