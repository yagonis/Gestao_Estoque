@php
    $links = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => '⌂'],
        ['label' => 'Produtos', 'route' => 'products.index', 'icon' => '◈'],
        ['label' => 'Categorias', 'route' => 'categories.index', 'icon' => '◇'],
        ['label' => 'Estoque', 'route' => 'stock.index', 'icon' => '▣'],
        ['label' => 'Usuários', 'route' => 'users.index', 'icon' => '◎'],
    ]
@endphp

<aside class="sidebar" aria-label="Menu principal">
    <div class="sidebar__brand">
        <span class="sidebar__logo"> GM </span>
        <div>
            <strong> Glamour Make </strong>
            <small> Gestão de Estoque </small>
        </div>
    </div>

    <nav class="sidebar__nav">
        @foreach ($links as $link)
            @php($isActive = request()->routeIs($link['route']))
            <a class="sidebar__link {{ $isActive ? 'sidebar__link--active' : ''}}" href="{{ Route::has($link['route']) ? route($link['route']) : "#" }}">
                <span> {{ $link['icon'] }}</span>
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>
</aside>