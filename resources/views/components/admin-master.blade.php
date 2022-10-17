<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
       <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
       <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <style>
    *:not(.fas){
        font-family: 'Poppins', sans-serif !important;
     }

    button[type="submit"]:not(.btn-danger),input[type="submit"]:not(.btn-danger){
        background: #4FA8A8;
        border: 3px solid #4FA8A8;
        border-radius: 5px;
        color: #fff;
        margin-top: 30px;
        width: 100%;
    }

    img{
        object-fit: cover;
    }

    /* label{
        margin-bottom: 5px;
    } */
    .form-group{
      margin-bottom: 15px;
    }
    label{
      margin-bottom: 10px;
    }
    input:focus{
        outline: 3px solid #4FA8A8 !important;
        border: none !important;
    }
    button[type="submit"]:focus:not(.btn-danger),input[type="submit"]:focus:not(.btn-danger){
        background: #4FA8A8;
        border: none !important;
        outline: none !important;
        border-radius: 5px;
        color: #fff;
        margin-top: 30px;
    }
    form:not(.delete){
    box-shadow: 0 0 10px rgba(0,0,0,0.13);
    padding: 30px;
    margin:10px 10px 20px 10px;
   }
   .alert{
    width: 370px !important;
    text-align: center;
    position: fixed;
    top: 17%;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 0 20px rgba(0,0,0,0.12);
    animation: slide-in 0.5s ease-out forwards;
    z-index: 100 !important;
   }
   .slideout{
    animation: slide-out 0.5s ease-out forwards;
   }
   @keyframes slide-in{
    0%{
        left: 50%;
        transform: translateY(-100%) translateX(-50%);
    }
    30%{
        left: 50%;
        transform: translateY(-50%) translateX(-50%);
    }
    60%{
        left: 50%;
        transform: translateY(-10%) translateX(-50%);
    }
    100%{
        left: 50%;
        transform: translateY(0%) translateX(-50%);
    }
   }
   @keyframes slide-out{
    0%{
        left: 50%;
        transform: translateY(0%) translateX(-50%);
    }
    30%{
        left: 50%;
        transform: translateY(-100%) translateX(-50%);
    }
    60%{
        left: 50%;
        transform: translateY(-200%) translateX(-50%);
    }
    100%{
        left: 50%;
        transform: translateY(-300%) translateX(-50%);
        display: none;
    }

   }
   /* div.nav{
    max-height: 400px;
    overflow-y: scroll;
   }
   div.nav::-webkit-scrollbar-track{ */
    /* width: 10px;
    color:#ccc; */
    /* background-color: rgb(209, 208, 208) !important;
   }
   div.nav::-webkit-scrollbar-thumb{
    background-color: rgb(164, 164, 164) !important;
    width: 5px !important;
   }
   .sb-sidenav-dark{
    background-color: #046969;
   }
   .section{
    background-color: #027a7a;
   } */
   .nav-link{
    color:#fff !important;
   }
</style>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/">Home</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
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
                            <a class="nav-link section" href="index.html">
                                <div class="sb-nav-link-icon">
                                    <img width="16" src="{{asset('images/dashboard.png')}}" alt="">
                                </div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link collapsed section" href="#" data-bs-toggle="collapse" data-bs-target="#Headlines" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <img width="16" src="{{asset('images/headline.png')}}" alt="">
                                </div>
                                Headlines
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Headlines" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('admin.create.Headline')}}">Create a Headline</a>
                                    <a class="nav-link" href="{{route('view.Headline')}}">View all Headlines</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed section" href="#" data-bs-toggle="collapse" data-bs-target="#Categories" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <img width="16" src="{{asset('images/category.png')}}" alt="">
                                </div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Categories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('admin.create.category')}}">Create a Category</a>
                                    <a class="nav-link" href="{{route('view.category')}}">View all Categories</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed section" href="#" data-bs-toggle="collapse" data-bs-target="#Posts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <img width="16" src="{{asset('images/post.png')}}" alt="">
                                </div>
                                   Posts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Posts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('admin.create.post')}}">Create a Post</a>
                                    <a class="nav-link" href="{{route('view.post')}}">View all Posts</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed section" href="#" data-bs-toggle="collapse" data-bs-target="#Users" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon">
                                    <img width="16" src="{{asset('images/users.png')}}" alt="">
                                </div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Users" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="{{route('view.create.admin')}}" >
                                        Create an Admin
                                        {{-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> --}}
                                    </a>
                                    {{-- <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div> --}}
                                    <a class="nav-link collapsed section" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                         Manage Users
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="{{route('admin.view.orders')}}">View all Orders</a>
                                            <a class="nav-link" href="{{route('admin.view.users')}}">View all Users</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>

                            <a class="nav-link collapsed section" href="#" data-bs-toggle="collapse" data-bs-target="#Cities" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <img width="16" src="{{asset('images/city.png')}}" alt="">
                                </div>
                                Cities
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="Cities" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{route('admin.create.city')}}">Create a City</a>
                                    <a class="nav-link" href="{{route('view.city')}}">View all Cities</a>
                                </nav>
                            </div>

                            {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> --}}
                        </div>
                    </div>

                </nav>
            </div>
            <div id="layoutSidenav_content">

            @yield('content')

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
        <script>
            let modal = document.querySelector('.alert');
            setTimeout(() => {
               modal.classList.add('slideout');
            }, 2000);
        </script>



    </body>
</html>
