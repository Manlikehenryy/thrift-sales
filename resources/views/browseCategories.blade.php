@include('components.navbar')
<style>
    .column-7{
        display: flex;
        flex-direction: column;
        width: 70%;
        margin-top: 70px;
        padding-left: 20px;
    }
    .column-3{
        display: flex;
        flex-direction: column;
        width: 30%;
    }
    .sidebar{
        width:30%;
        height: 70vh;
        padding: 50px 50px;
        background-color: #fff;
        position: fixed;
        left: 0;
        top: 60px;
    }
    .sidebar ul{
        padding:0px 0;
        height: 300px;
        overflow-y: scroll;
    }
    .sidebar ul::-webkit-scrollbar{
        background-color: #fff;
    }
    .sidebar-header{
        font-weight: 700;
    }
    .space{
        width:100%;
        height: 100vh;
        /* background-color: red; */
    }
    .row{
        /* width:100%; */
        display: flex;
        flex-wrap: wrap;
    }
    .flex{
        width:100%;
        display: flex;
    }
    .category-title{
        list-style: none;
        margin:25px 0 0 0;
        font-weight: 500;
        font-size: 15px;
        color: rgb(78, 78, 78);
        cursor: pointer;
    }
    .card-box{
        width: 240px;
        height: 400px;
        box-shadow: 0 0 10px rgba(0,0,0,0.15);
        border-radius:0 0 5px 5px;
        margin: 6px;
        position: relative;
    }
    .post-img{
    width: 240px;
    height: 200px;
    border-radius: 5px 5px 0 0;
    object-fit: cover;
    }
    .text-column{
        display: flex;
        flex-direction: column;
        padding: 10px 20px;
    }
    .cart-btn{
        width: 180px;
        height: 40px;
        border-radius: 6px;
        color: #fff;
        background-color: #4FA8A8;
        border: none;
        /* display: block;
        margin:0px auto; */
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%)
    }
    .add-cart{
        margin-left: 5px;
    }
    .flex-container{
        display: flex;
        flex-wrap: wrap;
        margin:40px 0;
    }
    .category-text{
        margin-left: 5px;
    }
    .title{
        font-size: 15px;
        font-weight: 600;
        color: rgb(78, 78, 78);
    }
    .price{
        font-size: 15px;
    }
    .btn-container{
        width: 180px;
        height: 40px;
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding-left: 7px;
    }
    .btn-plus,.btn-minus{
    background-color:#4FA8A8;
    border: none;
    padding: 0 10px;
    border-radius: 5px;
    font-size: 26px;
    color: #fff;
    margin: 0 17px;
}
.btn-minus{
    padding: 0 13px;
    /* opacity: 0.4; */
}
.item-qty{
    margin-top: 8px;
}
.hide{
    display: none;
}
    @media (max-width:1024px){
        .column-3{
        width: 0%;
        display: none;
    }
    .column-7{
        margin-top: 120px;
        width: 100%;
           padding-left: 0;
    }
    .flex-container{
        justify-content: center;
        margin:40px auto;
    }
    .category-text{
        margin: auto;
        font-weight: 700;
    }
    .card-box{
        margin: 15px;
    }
    }
</style>

<div class="flex">
    <div class="column-3">

        <div class="sidebar">

            <h3 class="sidebar-header">CATEGORY</h3>
           <ul>
            @php
             $count = 0;
            @endphp

            @foreach ($categories as $category )
              @foreach ($posts as $post)
                @if ($post->category_id === $category->id)
                @php
                     $id = 'cat-'.++$count;
                    echo "<li onclick='slideTo(`$id`)' class='category-title'>$category->title</li>"
                @endphp
                @break
               @endif
             @endforeach
          @endforeach
           </ul>
        </div>

        <div class="space"></div>
    </div>



@php
    $count = 0;
@endphp

<div class="column-7">
@if (count($categories) !== 0)
@foreach ($categories as $category )
@foreach ($posts as $post)
  @if ($post->category_id === $category->id)

  <h2 id="cat-{{$count+=1}}" class="category-text">{{$category->title}}</h2>
  @break
  @endif
@endforeach

        <div class="flex-container">

            @if (count($posts) !== 0)
            @foreach ($posts as $post )
            @if ($post->category_id === $category->id)
            <div class="">
                {{-- <a href="/shop/item/{{$post->id}}"> --}}
                 <div class="card-box">
                     <!-- Product image-->
                     <a href="/shop/item/{{$post->id}}">
                     <img class="post-img" src={{asset('images/'.$post->path)}} alt="..." />
                     <!-- Product details-->
                     <div class="text-column">
                        <div class="title">{{$post->title}}</div>
                        <div style="font-size: 13px;" class="title">
                            @if ($post->description&&strlen($post->description)<100)
                             {{$post->description}}
                             @elseif ($post->description)
                             {{substr($post->description,0,100).'...'}}
                            @endif
                        </div>
                        <div class="price">
                            <span class="text-muted text-decoration-line-through"><small>{{$post->old_amount ?'₦'.number_format($post->old_amount):''}}</small></span>
                            {{'₦'.number_format($post->current_amount)}}
                        </div>
                     </div>
                    </a>
                     <!-- Product actions-->
                     @if (Auth::check()&&Auth::user()->role==='customer'&&count($cart_array))
                     @if (isset($cart_array[$post->id]))
                     <div id="btn-container-{{$post->id}}" class="btn-container">
                         <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                        <span id="item-qty-{{$post->id}}" class="item-qty">{{$cart_array[$post->id]}}</span>
                         <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                      </div>

                      <button id="cart-btn-{{$post->id}}" onclick="store(<?=$post->id?>)" class="cart-btn hide"> Add to Cart
                         <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                         </button>
                    @else
                    <button id="cart-btn-{{$post->id}}" onclick="store(<?=$post->id?>)" class="cart-btn"> Add to Cart
                     <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                     </button>

                     <div id="btn-container-{{$post->id}}" class="btn-container hide">
                         <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                        <span id="item-qty-{{$post->id}}" class="item-qty"></span>
                         <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                      </div>
                   @endif

                     @elseif ($cart_session)
                      @if (isset($cart_session[$post->id]))
                        <div id="btn-container-{{$post->id}}" class="btn-container">
                            <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                           <span id="item-qty-{{$post->id}}" class="item-qty">{{$cart_session[$post->id]['qty']}}</span>
                            <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                         </div>

                         <button id="cart-btn-{{$post->id}}" onclick="store(<?=$post->id?>)" class="cart-btn hide"> Add to Cart
                            <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                            </button>
                       @else
                       <button id="cart-btn-{{$post->id}}" onclick="store(<?=$post->id?>)" class="cart-btn"> Add to Cart
                        <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                        </button>

                        <div id="btn-container-{{$post->id}}" class="btn-container hide">
                            <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                           <span id="item-qty-{{$post->id}}" class="item-qty"></span>
                            <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                         </div>
                      @endif

                      @else

                      <button id="cart-btn-{{$post->id}}" onclick="store(<?=$post->id?>)" class="cart-btn"> Add to Cart
                        <img class="add-cart" width="23" src="{{asset('images/add-cart.png')}}" alt="">
                        </button>

                        <div id="btn-container-{{$post->id}}" class="btn-container hide">
                            <button onclick="minus(<?=$post->id?>)" class="btn-minus">-</button>
                           <span id="item-qty-{{$post->id}}" class="item-qty"></span>
                            <button onclick="add(<?=$post->id?>)" class="btn-plus">+</button>
                         </div>
                     @endif




                 </div>
                {{-- </a> --}}
            </div>
            @endif

            @endforeach




           @endif
        </div>



    @endforeach
</div>


@else
<h3 class="text-center">There are no Products available currently!</h3>

@endif

</div>

<div id="success" class="alert alert-success hide">

</div>

<div id="danger" class="alert alert-danger hide">

</div>

<script>
     let modal = document.querySelector('.alert');
     $('#success').hide();
     $('#danger').hide();

     function store(val) {
     $.ajax({
        type:'GET',
        url:`/store/cart/${val}/item`,
        success:function(res) {
         $('#success').text('Ítem added to cart');
         $('#success').show();
         $(`#btn-container-${val}`).show();
         $(`#item-qty-${val}`).text(res.qty);
         $('.cart-badge').show();
         $('.cart-badge').text(res.total_qty);
         $(`#cart-btn-${val}`).hide();
    setTimeout(() => {
       modal.classList.add('slideout');
    }, 2000);
    setTimeout(() => {
       modal.classList.remove('slideout');
       $('#success').hide();
    }, 3000);
        }
     })
}

function add(val) {
     $.ajax({
        type:'GET',
        url:`/store/cart/${val}/item`,
        success:function(res) {
         $('#success').text('Ítem added to cart');
         $('#success').show();
         $(`#item-qty-${val}`).text(res.qty);
         $('.cart-badge').text(res.total_qty);
    setTimeout(() => {
       modal.classList.add('slideout');
    }, 2000);
    setTimeout(() => {
       modal.classList.remove('slideout');
       $('#success').hide();
    }, 3000);
        }
     })
}

function minus(val) {

     $.ajax({
        type:'GET',
        url:`/decrease/cart/${val}/item`,
        success:function(res) {
         $('#danger').text('Ítem removed from cart');
         $('#danger').show();
         if (res.qty>0) {
            $(`#item-qty-${val}`).text(res.qty);
         }
         else{
            $(`#btn-container-${val}`).hide();
         $(`#cart-btn-${val}`).show();
         }
         if (res.total_qty>0) {
            $('.cart-badge').text(res.total_qty);
         }
         else{
            $('.cart-badge').hide();
         }
    setTimeout(() => {
       modal.classList.add('slideout');
    }, 1500);
    setTimeout(() => {
       modal.classList.remove('slideout');
       $('#danger').hide();
    }, 2000);
        }
     })
}

// <img style="position: relative;top:-6px;" width="50px" height="37.59px" src="{{asset('images/spinn.gif')}}" alt="">

    $(document).ready(function () {
    //    function store(val) {

    //      alert(val)
    //    }
    })
</script>

<script>

</script>

<script>
      function slideTo(val) {
        document.querySelector(`#${val}`).scrollIntoView({behavior:'smooth'})
     }
     document.querySelector(<?php echo('"'.'#'.$cat.'"')?>).scrollIntoView({behavior:'smooth'});
</script>


@include('components.footer')
