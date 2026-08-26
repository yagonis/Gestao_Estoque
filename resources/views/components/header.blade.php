@props(['title'=> 'Dashboard'])

<header class="page-header">
    <div>
        <span class="page-header__eyebrow"> Painel Administrativo </span>
        <h1> {{ $title }} </h1>
    </div>

    <div class="page-header__right">
        @isset($actions)
            {{ $actions }}
        @else
            <span class="page-header__user"> {{ Auth::user()->name }} </span>
        @endisset
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
        class="page-header__logout ml-5"
        title="Sair"
        aria-label="Sair"
        >
        <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M10 17l5-5-5-5"/>
                    <path d="M15 12H3"/>
                    <path d="M21 19V5a2 2 0 0 0-2-2H10"/>
        </svg>
        </button>
    </form>
</header>