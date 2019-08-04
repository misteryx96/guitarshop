    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">Mladen's Guitar Shop</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    @isset($menus)
                        @foreach($menus as $menu)
                            <li><a href="{{ route($menu->link) }}">{{ $menu->naziv }}</a></li>
                        @endforeach
                    @endisset
                    @empty(session('user'))
                    <li><a href="{{ route('login_page') }}">Logovanje</a></li>
                    @endempty
                    @if(session()->has('user'))
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                    @endif
                    @empty(session('user'))
                    <li><a href='{{ route('reg_page') }}'>Registracija</a></li>
                    @endempty
                    @if(session('isAdmin'))
                    <li><a href='{{ route('admin_panel') }}'>Admin Panel</a></li>
                    @endif



                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>