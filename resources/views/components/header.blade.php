@props(['title'=> 'Dashboard'])

<header class="page-header">
    <div>
        <span class="page-header__eyebrow"> Painel Administrativo </span>
        <h1> {{ $title }} </h1>
    </div>

    <div class="page-header__actions">
        @isset($actions)
            {{ $actions }}
        @else
            <span class="page-header__user"> Administrador </span>
        @endisset
    </div>
</header>