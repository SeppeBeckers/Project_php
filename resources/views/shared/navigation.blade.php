
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="/"><h1>Hotel Kempenrust</h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact-us">Contact</a>
                    <a class="nav-link" href="/reservation/book">Boek een kamer</a>

                </li>
            </ul>
            {{--  Auth navigation  --}}
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/overview.blade.php"><i class="fas fa-sign-in-alt"></i>Admin Login</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/book"><i class="fas fa-user-cog"></i>Boek een kamer</a>

                            @if(auth()->user()->admin)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/overview"><i class="fas fa-compact-disc"></i>Overzicht</a>
                                <a class="dropdown-item" href="/admin/bill"><i class="fas fa-microphone-alt"></i>Rekening beheren</a>
                                <a class="dropdown-item" href="/admin/arrangement"><i class="fas fa-compact-disc"></i>Arrangement beheren</a>
                                <a class="dropdown-item" href="/admin/room"><i class="fas fa-compact-disc"></i>Kamers beheren</a>
                            @endif
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
