<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
    *:not(.fas){
        font-family: 'Poppins', sans-serif !important;
    }
    body {
        overflow-x: hidden;
        background-color: #fff !important;
    }
    a{
        text-decoration: none !important;
        color: black !important;
    }
    .account {
        margin-right: 10px;
    }

    nav.navbar {
        position: fixed;
        height: 60px;
        width: 100%;
        background-color: #fff !important;
        z-index: 50;
    }

    .cart-badge {
        position: absolute;
        left: 9px;
        top: -6px;
        width: 18px;
        height: 18px;
        background-color: #4FA8A8;
        border-radius: 50%;
        font-size: 12px;
        color: #fff;
        text-align: center;
    }
    .cart-container{
        position: relative;
        margin-left:8px;
    }
    .cart{
       margin-left: 10px;
    }
    div.container.px-4.px-lg-5{
        position: relative;
        margin-left: 0;
    }
    .menu-bar,.cart-cont{
        display: none;
    }
    .close{
        position: absolute;
        top: 21px;
        left: 10px;
        display: none;
    }

    .menu-modal{
        display: none;
    }
    a.user{
        display: none;
    }
    .alert{
    width: 370px !important;
    text-align: center;
    position: fixed;
    top: 12%;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 0 20px rgba(0,0,0,0.12);
    animation: slide-in 0.5s ease-out forwards;
    z-index: 100 !important;
   }
   .slideout{
    animation: slide-out 0.25s ease-out forwards;
   }
    @media (max-width:991px){
        .navbar-brand{
           margin-left: 30px;
        }
        .brand{
           margin-left: 50px;
           margin-bottom: 30px;
           font-size: 20px;
           font-weight: 600;
        }

    a.link{
        text-decoration: underline !important;
        font-size: 13px
    }
    .menu-modal{
        width:300px;
        height: 100vh;
        background: #fff;
        position: fixed;
        top: 0px;
        left: 0px;
        padding: 18px 0px;
        z-index: 59;
    }
    .backdrop{
        width: 100%;
        height: 100vh;
        background-color: #000;
        opacity: 0.4;
        position: fixed;
        z-index: 52;
        display: none;
    }
    .cart-cont{
        position: absolute;
        top: 8.5px;
        right: 10px;
        display: block;
    }
    .menu-bar{
        position: absolute;
        top: 12px;
        left: 20px;
        display: block;
    }
    .nav-section{
       margin: 10px 13px;
    }
    .nav-head{
        color: orangered;
        font-size: 14px;
        font-weight: 500;
    }
    .nav-section ul li{
        list-style: none;
        margin-left: 0px;
    }
    .nav-section ul{
        padding-left: 0px;
    }
    .divider{
        color:rgb(160, 158, 158);
    }
    a.user{
        position: absolute;
        top: 0px;
        right: 28px;
        display: block;
    }
    a.navbar-brand{
        position: absolute;
        top: 2px;
        left: 28px;
    }
    div.container.px-4.px-lg-5{
        padding-right: 0 !important;
    }
    .alert{
    width: 300px !important;
   }
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
    }

   }
   .dropdown-item:focus{
     background: #fff;
   }
</style>

<script defer>
    $(document).ready(function () {
        $('.menu-bar').click(function () {
          showModal();
        })

        $('.close').click(function () {
          closeModal();
        })

        $('.backdrop').click(function () {
          closeModal();
        })

        function showModal(){
            $('.menu-bar').hide();
            $('.close').show();
             $('.menu-modal').show();
             $('.backdrop').show();
        }
        function closeModal() {
            $('.menu-bar').show();
            $('.close').hide();
             $('.menu-modal').hide();
             $('.backdrop').hide();
        }
    })

</script>

<body>
    <!-- Navigation-->

<div class="backdrop"></div>
<div class="menu-modal">

    <div class="close" >
        <img width="20px;" src="{{asset('images/close.png')}}" alt="">
    </div>
    <a class="brand" href="/">Home</a>

    <hr class="divider" >
  <div class="nav-section">
      <div style="display: flex; justify-content:space-between;">
        <div class="nav-head">Our Categories</div>
        <a class="link" href="/browse/categories/all">See All</a>
      </div>
      <ul>
        @php
        $count=0;
    @endphp
    @foreach ($categories as $category)
          @foreach ($posts as $post)
               @if ($category->id === $post->category_id)
               <li class="nav-list"><a class="" href="/browse/categories/cat-{{$count+=1}}">{{$category->title}}</a></li>
               @break
               @endif
          @endforeach
    @endforeach
      </ul>
  </div>

  <hr class="divider">

  <div class="nav-section">
    <div style="display: flex; justify-content:space-between;">
      <div class="nav-head">My Account</div>
    </div>
    <ul>
      @if (Auth::check() && Auth::user()->role === 'admin')
      <li class="nav-list"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
      @endif
      @if (!Auth::check() || Auth::user()->role==='customer')
     <li class="nav-list"><a href="{{ route('user.orders') }}">Orders</a></li>
     @endif
     <li class="nav-list"><a href="{{ route('view.change.password') }}">Change Password</a></li>
    </ul>
</div>
</div>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container px-lg-5">

            <div class="menu-bar" >
                <img width="24px;" src="{{asset('images/menu.png')}}" alt="">
            </div>

            @if (Auth::check() && Auth::user()->role!='admin')
            <a class="cart" href="{{ route('view.cart.item') }}">
            <span class="cart-cont">
                <img width="22" src="{{ asset('images/carts.png') }}" alt="">
                @if ($total_qty)
                <span
                class="cart-badge">{{$total_qty}}
                </span>
                @else
                <span
                class="cart-badge hide">
                </span>
                @endif

            </span>
        </a>
            @else
            <a class="cart" href="{{ route('view.cart.item') }}">
            <span class="cart-cont">
                <img width="22" src="{{ asset('images/carts.png') }}" alt="">
                @if (Session::has('cart'))
                <span
                class="cart-badge">{{Session::get('cart')->total_qty}}
                </span>
                @else
                <span
                class="cart-badge hide"></span>
                    @endif

            </span>
        </a>
            @endif



            @if (!Auth::check())

                    <a class="nav-link user" href="{{ route('login') }}">
                        <img width="22" src="{{asset('images/user.png')}}" alt="">
                    </a>

            @else

                    <a class="nav-link user"  href="#" role="button"
                         aria-expanded="false">
                         <img width="30" src="{{asset('images/checked-user.png')}}" alt="">
                    </a>
            @endif

            <a class="navbar-brand" href="/">Home</a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="navbarDropdown" href="/" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/browse/categories/all">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            @php
                                $count=0;
                            @endphp
                            @foreach ($categories as $category)
                                  @foreach ($posts as $post)
                                       @if ($category->id === $post->category_id)
                                       <li><a class="dropdown-item" href="/browse/categories/cat-{{$count+=1}}">{{$category->title}}</a></li>
                                       @break
                                       @endif
                                  @endforeach
                            @endforeach
                        </ul>
                    </li>

                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                    @endif
                </ul>

                @if (!Auth::check())
                    <ul class="navbar-nav account">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('login') }}">
                                <img width="22" src="{{asset('images/user.png')}}" alt="">
                                <span style="margin-left:8px;">Sign in</span>
                            </a>

                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav account">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img width="30" src="{{asset('images/checked-user.png')}}" alt="">
                                <span>Hi, {{Auth::user()->first_name}}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                               @if (Auth::user()->role==='customer')
                               <a class="dropdown-item" href="{{ route('user.orders') }}">
                                Orders
                            </a>
                               @endif
                                <a class="dropdown-item" href="{{ route('view.change.password') }}">
                                    Change Password
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    Logout
                                </a>
                            </ul>
                        </li>

                    </ul>
                @endif



                <div class="d-flex">
                    @if (!Auth::check())
                        <a class="cart" href="{{ route('view.cart.item') }}">
                            <div>
                                Cart
                                  <span class="cart-container">
                                     <img width="22" src="{{ asset('images/cart2.png') }}" alt="">
                                     @if (Session::has('cart'))
                                     <span
                                     class="cart-badge">{{Session::get('cart')->total_qty}}
                                     </span>
                                     @else
                                     <span
                                     class="cart-badge hide"></span>
                                         @endif

                                    </span>

                            </div>
                        </a>
                    @elseif (Auth::user()->role === 'customer')
                    <a class="cart" href="{{ route('view.cart.item') }}">
                        <div>
                            Cart
                            <span class="cart-container">
                                <img width="22" src="{{ asset('images/cart2.png') }}" alt="">
                                @if ($total_qty)
                                <span
                                class="cart-badge">{{$total_qty}}
                                </span>
                                @else
                                <span
                                class="cart-badge hide">
                                </span>
                                @endif

                                </span>
                        </div>
                    </a>

                    @endif


                </div>


            </div>
        </div>
    </nav>

