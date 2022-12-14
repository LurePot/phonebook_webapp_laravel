<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
       
		<title> @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ url('assets/css/astyles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
           .bg-image {
            background-image: url('assets/imgages/background/auth.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        </style>
		@yield('css')
	</head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ url('/dashboard') }}">PhoneBook</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form action="{{ route('search') }}" method="GET" class="d-none d-md-inline-block form-inline ms-auto me-2 col-lg-2 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                        <input class="form-control" type="text" name="search" placeholder="Search for..." required/>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    
                </div> 
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                @if (!(Auth::user()?->profile) || (Auth::user()?->profile->image == '' ))
                    <picture><img width="35px" src="{{ url(Storage::url('public/contact/default2.png')) }}" class="profile pt-1"/></picture> 
                    @else
                        <picture><img width="35px" src="{{url(Storage::url('public/contact/'.Auth::user()->profile->image))}}" alt="{{auth()->user()?->name}}" class="profile pt-1"/></picture>
                    @endif
                    <!--end if -->
                <li class="nav-item dropdown">
            
                    <a class="nav-link dropdown-toggle text-capitalize" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()?->name}}</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-success" href="#!"><i class="fa-solid fa-user text-success"></i>&nbsp;&nbsp;Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <i class="fa-solid fa-right-from-bracket text-danger"></i>
                                <input class="btn btn-outline-none btn-sm text-danger" type="submit" value="Logout">
                            </form></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ url('/dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Contacts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ url('/contact/create') }}">Add Contact</a>
                                    <a class="nav-link" href="{{ url('/contact') }}">View Contacts</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Favorite List
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Family
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Friends
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Clints
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small text-capitalize">Logged in as: {{ Auth::user()->name }}</div>
                        Phonebook
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div>
                            <h1 class="mt-4 text-lg-start text-center text-info">PhoneBook</h1>
                        <span class=" mb-5">
                            <h5 class=" text-lg-start text-center text-capitalize">of {{ Auth::user()->name }}</h5>
                        </span> <br>
                        </div>
                        {{-- ================================================ --}}
						@yield('content')
                        {{-- ================================================ --}}
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PhoneBook {{ date("Y") }}</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('assets/js/ascripts.js')}}"></script>
        <script src="{{ url('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{ url('assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ url('assets/js/datatables-simple-demo.js')}}"></script>
        <script>
             $(document).ready(function() {

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
            // =========
             });
        </script>
		@yield('script')
    </body>
</html>
