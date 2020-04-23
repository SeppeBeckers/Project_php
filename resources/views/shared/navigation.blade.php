<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-success border-bottom">
    <div class="container">
        <a class="navbar-brand hotel-name mx-3" href="{{ url('/') }}">
            Hotel Kempenrust
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link white-hover mx-5 btn btn-outline-secondary px-3" href="/reservation/book">Boek een kamer</a>

                @guest

                <li class="nav-item mr-xl-5">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Inloggen') }}</a>
                </li>

                @else

                <li class="nav-item ml-xl-5 ">
                    <a class="nav-link text-success" href="/admin/overview">Overzicht boekingen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success" href="/admin/room">Kamers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success" href="/admin/arrangement">Arrangementen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-success" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ __('Uitloggen') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

                @endguest
                <li class="nav-item ml-md-5">
                    <a class="nav-link handleiding" href="/assets/Handleiding.pfd"> <i class="fas fa-question-circle mr-1"></i>Handleiding</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
