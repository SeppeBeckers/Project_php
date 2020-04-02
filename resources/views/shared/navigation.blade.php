
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-success border-bottom">
                <div class="container">
                    <a class="navbar-brand hotel-name" href="{{ url('/') }}">
                        Hotel Kempenrust
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link ml-5 btn btn-outline-success px-3" href="/reservation/book">Boek een kamer</a>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Inloggen') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right  border-success" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/admin/overview">Overzicht boekingen</a>
                                        <a class="dropdown-item" href="/reservation/book">Nieuwe Reservatie</a>
                                        <a class="dropdown-item" href="/admin/room">Kamers beheren</a>
                                        <a class="dropdown-item" href="/admin/arrangement">Arrangementen beheren</a>
                                        <a class="dropdown-item" href="/admin/bill">Rekening</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Uitloggen') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>               
</nav>
