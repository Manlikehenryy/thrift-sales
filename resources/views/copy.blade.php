{{-- @include('components.navbar') --}}
        {{-- <link rel="stylesheet" href="{{asset('css/cart.css')}}"> --}}

 {{-- <div class="cart-contain"> --}}
   {{-- <div class="column"> --}}
    {{-- @if (Auth::check()&&$total_qty)
    <div class="box">
        <div class="header">Cart ({{number_format($total_qty)}})</div>
        @php
        $total_price = 0;
    @endphp
         @foreach ($carts as $cart)
         @php
             $total_price += $cart->qty * $cart->post->current_amount;
         @endphp --}}
          {{-- <hr> --}}
          {{-- <a href="/shop/item/{{$cart->post->id}}">
         <div class="cart-item">
            <div class="col">
              <div class="flex">
                  <img class="cart-img" width="60px" height="60px" src="{{asset('images/'.$cart->post->path)}}" alt="">
                  <div class="cart-text">{{$cart->post->title}}</div>
              </div>
              <a class="text-remove" href="{{route('remove.cart.item',$cart->post->id)}}">
                <img width="25px" class="bin" src="{{asset('images/bin.png')}}" alt="">
                REMOVE</a>
            </div>

            <div class="col relative">
                  <div class="amount">
                    <div  class="curr-amount">{{'₦'.number_format($cart->post->current_amount)}}</div>
                  <div class="old-amount"><strike>{{$cart->post->old_amount?'₦'.number_format($cart->post->old_amount):''}}</strike>
                    <span class={{$cart->post->old_amount?'discount':''}}>{{$cart->post->old_amount? round(((($cart->post->current_amount/$cart->post->old_amount)*100)-100)).'%': ''}}</span>
                </div>
                  </div>

            </div>

            <div class="flex btn-abs">
                <a href="{{route('decrease.cart.item',$cart->post->id)}}"><button class="btn-minus">-</button></a>
                  <span class="item-qty">{{$cart->qty}}</span>
                  <a href="{{route('store.cart.item',$cart->post->id)}}"><button class="btn-plus">+</button></a>
              </div>
          </div>
        </a>
         @endforeach

    </div>

    <div class="checkout-card">
        <a href="{{route('checkout.cart')}}">
            <button class="checkout-btn" type="submit">CHECKOUT ({{'₦'.number_format($total_price)}})</button>
        </a>

     </div>

        @elseif ($cart_items !== null)
        <div class="box">
            <div class="header">Cart({{Session::get('cart')->total_qty}})</div>
             @foreach ($cart_items as $item)
             <hr>
             <a href="/shop/item/{{$item['item']->id}}">
             <div class="cart-item">
                <div class="col">
                  <div class="flex">
                      <img class="cart-img" width="60px" height="60px" src="{{asset('images/'.$item['item']->path)}}" alt="">
                      @if (strlen($item['item']->title)<25)
                      <div class="cart-text">{{$item['item']->title}}</div>
                      @else
                      <div class="cart-text">{{substr($item['item']->title,0,24)}}...</div>
                      @endif
                  </div>
                  <a class="text-remove" href="{{route('remove.cart.item',$item['item']->id)}}">
                    <img width="25px" class="bin" src="{{asset('images/bin.png')}}" alt="">
                    REMOVE</a>

                    <div class="col relative">
                        <div class="amount">
                            <div class="curr-amount">{{'₦'.number_format($item['price'])}}</div>
                            <div class="old-amount">
                                <strike>{{$item['item']->old_amount?'₦'.number_format($item['item']->old_amount):''}}</strike>
                                <span class={{$item['item']->old_amount?'discount':''}}>{{$item['item']->old_amount?round(((($item['item']->current_amount/$item['item']->old_amount)*100)-100)).'%': ''}}</span>
                            </div>
                        </div>

                        </div>

                        <div class="flex btn-abs">
                            <a href="{{route('decrease.cart.item',$item['item']->id)}}"><button class="btn-minus">-</button></a>
                              <span class="item-qty">{{$item['qty']}}</span>
                              <a href="{{route('store.cart.item',$item['item']->id)}}"><button class="btn-plus">+</button></a>
                          </div>
                </div>


              </div>
            </a>
             @endforeach --}}

        {{-- </div> --}}

        {{-- <div class="checkout-card">
            <a href="{{route('checkout.cart')}}">
                <button class="checkout-btn" type="submit">CHECKOUT ({{'₦'.number_format(Session::get('cart')->total_price)}})</button>
            </a>

         </div>
      @endif --}}





   {{-- </div> --}}

   @if ($cart_items === null&&!$total_qty)
   <div class="column-empty">

     <div class="cart-empty">
         <div style="position:absolute; left:50%;top:30px; transform:translateX(-50%);" >
             <img width="200" height="150" src="{{asset('images/cart.gif')}}" alt="">
             <p class="text-center"><b>Your cart is empty!</b></p>
            <a href="/browse/categories/all"><button class="shop-btn" type="submit">START SHOPPING</button></a>

          </div>
     </div>
 {{-- <div style="margin-bottom:600px;">

 </div> --}}
   </div>
    @endif

<div class="swipe-cont  <?php if ($cart_items === null&&!$total_qty) { echo 'center-box';} ?>">
    <div id="leftBtn" class="left-btn"><div class="arrow"><</div></div>
    <div id="rightBtn" class="right-btn"><div class="arrow">></div></div>
    <h5 style="background-color: #cdefef;" class="card-head">Latest deals</h5>
    <div class="swipe">
       @foreach ($latest_posts as $latest_post)
       <a href="/shop/item/{{$latest_post->id}}">
       <div class="cardbox">
        <div class="card-img">
            <div class={{$latest_post->old_amount?'card-discount':''}}>{{$latest_post->old_amount?round(((($latest_post->current_amount/$latest_post->old_amount)*100)-100)).'%': ''}}</div>

         <img style="object-fit:cover;border-radius:4px 4px 0 0" width="200px" height="190px" src="{{asset('images/'.$latest_post->path)}}" alt="">
        </div>
         <div class="card-items">
             <div class="card-title">

             @if (strlen($latest_post->title)<18)
             {{$latest_post->title}}
             @elseif ($latest_post->title)
             {{substr($latest_post->title,0,18).'...'}}
            @endif
             </div>
             <div class="price">
                 {{'₦'.$latest_post->current_amount}}
             </div>
             <div class="old-price">
                 <strike><small>{{$latest_post->old_amount?'₦'.$latest_post->old_amount:''}}</small></strike>
             </div>
         </div>
       </div>
        </a>
       @endforeach

   </div>
</div>

@if (Session::has('views'))
<div class="recent-cont  <?php if ($cart_items === null&&!$total_qty) { echo 'center-box';} ?>">
    <div id="recentleftBtn" class="left-btn"><div class="arrow"><</div></div>
    <div id="recentrightBtn" class="right-btn"><div class="arrow">></div></div>
    <h5 class="card-head">Recently viewed</h5>
    <div class="recent">
       @foreach (Session::get('views') as $post)
      <a href="/shop/item/{{$post->id}}">
        <div class="recentbox">
            <div class="card-img">
                <div class={{$post->old_amount?'card-discount':''}}>{{$post->old_amount?round(((($post->current_amount/$post->old_amount)*100)-100)).'%': ''}}</div>

             <img style="object-fit:cover;border-radius:4px 4px 0 0" width="200px" height="190px" src="{{asset('images/'.$post->path)}}" alt="">
            </div>
             <div class="card-items">
                 <div class="card-title">

                 @if (strlen($post->title)<18)
                 {{$post->title}}
                 @elseif ($post->title)
                 {{substr($post->title,0,18).'...'}}
                @endif
                 </div>
                 <div class="price">
                     {{'₦'.$post->current_amount}}
                 </div>
                 <div class="old-price">
                     <strike><small>{{$post->old_amount?'₦'.$post->old_amount:''}}</small></strike>
                 </div>
             </div>
           </div>
      </a>
       @endforeach


   </div>
</div>

@endif

   <br>
   <br><br><br>

   {{-- @if (Auth::check()&&$total_qty)
   <div class="summary">
    <div class="summ-header">CART SUMMARY</div>
    <hr>
    <div class="subtotal">
        <div>Subtotal:</div>
        <div class="total-price">{{'₦'.number_format($total_price)}}</div>
    </div>
    <div class="delivery">Delivery fees not included yet.</div>
        <a href="{{route('checkout.cart')}}">
            <button class="total-btn" type="submit">CHECKOUT ({{'₦'.number_format($total_price)}})</button>
        </a>


</div>
<div class="space"></div>
     @elseif ($cart_items !== null)
     <div class="summary">
        <div class="summ-header">CART SUMMARY</div>
        <hr>

          <div class="subtotal">
            <div>Subtotal:</div>
            <div class="total-price">{{'₦'.number_format(Session::get('cart')->total_price)}}</div>
          </div>

        <div class="delivery">Delivery fees not included yet.</div>
        <hr>
            <a href="{{route('checkout.cart')}}">
          <button class="total-btn" type="submit">CHECKOUT ({{'₦'.number_format(Session::get('cart')->total_price)}})</button>
        </a>
    </div>
    <div class="space"></div>

     @endif --}}
 </div>
 @include('components.footer')


 <style>
    /* .card-head{
        margin: 10px 0 0 10px;
        font-size: 17px;
    } */
    .card-head{
        /* margin: 10px 0 0 10px; */
        padding: 10px 0 10px 10px;
        font-size: 17px;
    }
    .card-title,.price{
        font-size: 16px;
    }
    .old-price{
        font-size: 14px;
    }
    .card-items{
        margin-top: 10px;
        text-align: left;
        padding-left: 10px;
    }
    .card-img{
        width: 200px;
        height: 190px;
        position: relative;
    }
    .card-discount{
    background-color: #cce1e1;
    color: #319595;
    font-size: 13px;
    font-weight: 700;
    padding: 0 2.5px 2.5px 2.5px!important;
    position: absolute;
    right: 10px;
    top: 10px;
}
    .arrow{
        color:#fff;
        z-index: 12;
        font-size: 20px;
    }
    .left-btn,.right-btn{
      cursor: pointer;
      width: 40px;
      height: 40px;
      background-color: #000;
      opacity: 0.45;
      position: absolute;
      z-index: 10;
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      text-align: center;
      padding-top: 5px;
      display: none;
    }
    .left-btn{
        left: 0px;
    }
    .right-btn{
       right:0px;
    }
    .swipe-cont,.recent-cont{
        position: relative;
        /* height: 350px; */
        margin: 20px 20px;
        width:66.5%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    }

    .swipe,.recent{
        position: relative;
        height: 300px;
        width: 98.7%;
        display: flex;
        /* margin: 0 0px 0 0; */
        /* padding: 10px; */
        overflow: hidden;
        background-color: #fff;
    }
    .center-box{
        margin: 30px auto;
        width: 81%;
    }
    .cardbox,.recentbox{
        position: absolute;
        top: 0;
        width: 200px;
        height: 90%;
        margin: 10px;
        background-color: #fff;
        transition: 0s ease-in;
        text-align: center;
        font-size: 30px;
    }
    .checkout-card{
        display: none;
    }
    body{
        background-color: #f2f2f2 !important;
    }
    .cart-empty{
        position: relative;
        margin: auto;
        /* display: block; */
        /* left: 50%; */
        /* top: 20%; */
        /* transform: translateX(-50%); */
        width: 100%;
        height: 300px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    footer{
     width: 100% !important;
     text-align: center !important;
     position: relative;
     bottom: 0px;
    }
    .box{
    width: 100%;
    padding:0 10px 20px 10px;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.1) !important;
    background-color: #fff;
}
.margin{
    margin-top: 30px;
}
.discount{
    background-color: #cce1e1;
    color: #319595;
    font-size: 13px;
    font-weight: 700;
    padding: 0 2.5px 2.5px 2.5px!important;
}
.subtotal{
    position: relative;
}
.summ-header,.subtotal,.delivery{
    margin-left:10px;
}
.summ-header{
    margin-top: 10px;
    font-weight: 600;
}
.delivery{
    font-size: 12px;
    margin-top: 10px;
    color: rgb(122, 122, 122);
}
.total-btn{
    width: 90%;
    height: 40px;
    background-color: #4FA8A8;
    border: none;
    border-radius: 5px;
    color: #fff;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

}
.shop-btn{
    width: 200px;
    height: 40px;
    background-color: #4FA8A8;
    border: none;
    border-radius: 5px;
    color: #fff;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: -30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

}
.total-price{
    position: absolute;
    right: 10px;
    top: 0px;
    font-size: 20px;
    font-weight: 600;
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
    margin-top: 5px;
}
.amount{
    margin-left: 100px;
    width: 100px
}
.old-amount{
   position: relative;
   right: 25px;
}

.curr-amount{
    position: relative;
   right: -22px;
}
.summary{
 width: 30%;
 height: 200px;
 position: fixed;
 top: 60px;
 right: 20px;
 box-shadow: 0 0 22px rgba(0, 0, 0, 0.1) !important;
 background-color: #fff;
 z-index: 12;
}
a.text-remove{
    color:#4FA8A8 !important;
    font-size: 15px;
    /* color:#d7ffff !important; */
}
img.bin{
    margin:0 6px 6px 6px;
}
.space{
    width: 30%;
 height: 200px;
}
.box,.summary{
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    margin: 50px 10px;
}
.cart-img{
    border-radius: 4px;
    object-fit: cover;
}
.cart-item{
    position: relative;
    width: 100%;
    height: 120px;
    display: flex;
     background-color: #f0f1f1 !important;
     margin-bottom: 10px;

}
.cart-text{
  margin-left: 20px;
  font-size: 18px;
}
.cart-contain{
  display: flex;
  flex-direction: column;
  width:100% !important;
  padding: 0 !important;
}
.column{
    display: flex;
    flex-direction: column;
    margin: 60px 20px 20px 20px;
    width:64%;
}
.column-empty{
    width: 81% ;
    margin: 10px auto 40px auto !important;
}
hr{
    background-color: rgb(175, 172, 172);
}
.header{
 width: 100%;
 height: 40px;
 /* border-bottom: 1px solid rgb(231, 226, 226); */
 padding: 7px 0 0 10px;
 font-size: 20px;
 font-weight: 600;
}
.col{
    display: flex;
    flex-direction: column;
    /* margin: 0 0 0 0px; */
}
.flex{
    display: flex;
    margin: 10px;
}
.relative{
    position: absolute;
    right: -20px;
    top: 10px;
}
.btn-abs{
    position: absolute;
    right: -17px;
    bottom: 8px;
}
@media (max-width:991px){
    .card-head{
        /* margin: 10px 0 0 0; */
        padding-left: 35px;
    }
    .left-btn,.right-btn{
      display: none;
    }
    /* .swipe{
       margin: 0 auto;
       width: 90%;
    }
    .swipe-cont{
        width: 100%;
    } */
    .swipe,.recent{
       margin: 0 auto;
       width: 90%;
    }
    .swipe-cont,.recent-cont{
        width: 100%;
        margin-left: 0;
    }
    .cart-contain{
        padding: 0 !important;
        box-sizing: none !important;
    }
    .checkout-card{
        margin: 10px auto;
        position: fixed;
        display: block;
        width: 100% !important;
        height: 60px;
        background-color: #fff;
        padding: 10px 0 ;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        bottom: -10px;
        z-index: 400;
    }
    .checkout-btn{
    width: 90%;
    height: 40px;
    background-color: #4FA8A8;
    border: none;
    border-radius: 5px;
    color: #fff;
    margin: auto;
    display: block;
    /* position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10px; */
}
        .summary{
      display: none;
}
.space{
    display: none;
    width: 0%;
}
.column{
    width: 95% ;
    margin: 60px auto;
    align-items: center;
}
.column-empty{
    width: 95% ;
    margin: 60px auto;
}
    }
    @media (max-width:500px){
.cart-text{
            margin-left: 8px;
        }
.cart-text,.amount,.item-qty{
        font-size: 14px;
     }
.btn-plus,.btn-minus{
    padding: 0 10px;
    font-size: 20px;
    margin: 0 17px;
}
.btn-minus{
    padding: 0 13px;
    /* opacity: 0.4; */
}
.header{
    font-size: 16px;
}
.btn-abs{
    right:-10px;
}
.text-remove{
    font-size: 14px !important;
}
.cart-empty{
        width: 90%;
 }
    }
 </style>

 <script>
    let summary = document.querySelector('.summary').getBoundingClientRect();
    let swiper = document.querySelector('.box').getBoundingClientRect();

    function scroll() {
    console.log(document.documentElement.scrollTop);

    console.log('offset top for summary:'+document.querySelector('.summary').offsetTop);
    console.log(summary.top);
    console.log('offset top for box:'+document.querySelector('.box'));
    console.log(swiper.top);

     if (document.documentElement.scrollTop>=swiper.bottom-summary.bottom) {
       alert('reached')
     }
    }
    window.onscroll = function () {
  scroll();
};

 </script>

<script>
    let recentBox = document.querySelectorAll('.recentbox');
    let recent = document.querySelector('.recent');
    let leftBtn_ = document.querySelector('#recentleftBtn')
    let rightBtn_ = document.querySelector('#recentrightBtn')
    let rightTurn_ = 0;
    let leftTurn_ = 0;


    let pressed_ = false;
    let startx_;
    let x_;
    let position_ = 0;
    const positionArray_ = [];
    let movements_=[]


    document.querySelector('.recent-cont').addEventListener('mouseenter',function () {
        leftbtnBoundary_()
        rightbtnBoundary_()
    })

    document.querySelector('.recent-cont').addEventListener('mouseleave',function () {
        rightBtn_.style.display = 'none';
        leftBtn_.style.display = 'none';
    })


    // SETS INITIAL POSITION FOR THE BOXES
    recentBox.forEach((val,i)=>{
        val.style.left += `${position_}px`;
        positionArray_[i] = position_;
        position_ += 210;
    })


    if (screen.width>=1000) {
        recentBox.forEach((val,i)=>{
        val.style.transition += '0.5s ease-out';
    })
    }

    leftBtn_.addEventListener('click',function() {
    if (parseInt(recentBox[0].style.left)<0) {
        rightTurn_ -= 4
       let value_ = movements_.shift();
        recentBox.forEach((val,index)=>{
        val.style.left = `${positionArray_[index]+(210*value_)}px`;
      })
      recentBox.forEach((val,index)=>{
        positionArray_[index] = parseInt(val.style.left);
      })
    }

    leftbtnBoundary_()
    rightbtnBoundary_()
    })



    rightBtn_.addEventListener('click',function() {
    rightTurn_ += 4;
    if (rightTurn_<recentBox.length) {
      if (!(recentBox.length-rightTurn_<4)) {
        recentBox.forEach((val,index)=>{
        val.style.left = `${positionArray_[index]-210*4}px`;
      })
      movements_.push(4);
      recentBox.forEach((val,index)=>{
        positionArray_[index] = parseInt(val.style.left);
      })
      }
      else{
        recentBox.forEach((val,index)=>{
        val.style.left = `${positionArray_[index]-210*(recentBox.length-rightTurn_)}px`;
      })
      recentBox.forEach((val,index)=>{
        positionArray_[index] = parseInt(val.style.left);
      })
      movements_.push(recentBox.length-rightTurn_);
      }
    }
    else{
        rightTurn_ -= 4;
    }

    leftbtnBoundary_()
    rightbtnBoundary_()
    })

    // EVENT LISTENER FOR TOUCHSTART, INITIALIZES START POSITION
    recentBox.forEach((val,i) => {
        recentBox[i].addEventListener('touchstart',function(e) {
    startx_ = e.touches[0].clientX;
    })
    });


    // EVENT LISTENER FOR TOUCHMOVE
    recentBox.forEach((val,i) => {
        recentBox[i].addEventListener('touchmove',function(e){
       if (recentBox.length>=3&&screen.width<=630) {
        var touch_ = e.touches[0];

    var change_ = touch_.clientX - startx_;

    // CHECKS IF THE SWIPE DIRECTION IS FORWARD
    if(change_<0){
     // console.log(cardBox[cardBox.length-1].getBoundingClientRect());
     // console.log(swipe.getBoundingClientRect());
     for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${positionArray_[i]+change_}px`;
    }
    rightBoundary_();
    }

    // CHECKS IF THE SWIPE DIRECTION IS BACKWARD
    else{
    for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${change_+positionArray_[i]}px`;
    }

    leftBoundary_();
    }

    e.preventDefault();
       }
       else if (recentBox.length>=5&&screen.width<=1024) {
        var touch_ = e.touches[0];

    var change_ = touch_.clientX - startx_;

    // CHECKS IF THE SWIPE DIRECTION IS FORWARD
    if(change_<0){
     for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${positionArray_[i]+change_}px`;
    }
    rightBoundary_();
    }

    // CHECKS IF THE SWIPE DIRECTION IS BACKWARD
    else{
    for (let i = 0; i < recentBox.length; i++) {
    recentBox[i].style.left = `${change_+positionArray_[i]}px`;
    }

    leftBoundary_();
    }

    e.preventDefault();
       }
    })


    });


    // EVENT LISTENER FOR TOUCHEND
    recentBox.forEach((val,i) => {
        recentBox[i].addEventListener('touchend',function(e){
        var change_ = startx_ - e.changedTouches[0].clientX

    // CHECKS IF THE SWIPE DIRECTION IS FORWARD
       if (change_>0) {

    // CHECKS IF THE BOX HAS BEEN SWIPED HALFWAY OUT OF THE SCREEN AND IF ITS NOT THE LAST ELEMENT
           if (change_>210/2) {
           for (let i = 0; i < positionArray_.length; i++) {
                positionArray_[i] = parseInt(recentBox[i].style.left);
            }
           }
           // ELSE ROLLBACK TO PREV POSITION
           else{
            for (let i = 0; i < cardBox.length; i++) {
                recentBox[i].style.left = `${positionArray_[i]}px`;
            }
           }

       }

    // CHECKS IF THE SWIPE DIRECTION IS BACKWARD
       else{
        if (-change_>210/2) {
           for (let i = 0; i < positionArray_.length; i++) {
                positionArray_[i] = parseInt(recentBox[i].style.left);
            }
           }

    // ELSE ROLLBACK TO PREV POSITION
         else{
            for (let i = 0; i < cardBox.length; i++) {
                recentBox[i].style.left = `${positionArray_[i]}px`;
            }
         }
       }


    e.preventDefault();

    })


    });

    function rightbtnBoundary_() {
    if (parseInt(recentBox[recentBox.length-1].style.left)<=630) {
      rightBtn_.style.display = 'none';
    }
    else{
        rightBtn_.style.display = 'block';
    }
    }

    function leftbtnBoundary_() {
    if (parseInt(recentBox[0].style.left)>=0) {
        leftBtn_.style.display = 'none';
    }
    else{
        leftBtn_.style.display = 'block';
    }
    }

    function rightBoundary_() {
    if (recentBox[recentBox.length-1].getBoundingClientRect().right<recent.getBoundingClientRect().right) {
       let width_ = recent.getBoundingClientRect().width - recentBox[recentBox.length-1].getBoundingClientRect().width - 20;
        for (let k = recentBox.length-1; k >= 0; k--) {
            recentBox[k].style.left = `${width_}px`;
            width_ -= 210;
        }
        recentBox[recentBox.length-1].style.left = `${recent.getBoundingClientRect().width - recentBox[recentBox.length-1].getBoundingClientRect().width - 20}px`
    }
    }

    function leftBoundary_() {
    if (parseInt(recentBox[0].style.left)>0) {
       let width_ = 0;
        for (let k = 0; k < recentBox.length; k++) {
            recentBox[k].style.left = `${width_}px`;
            width_ += 210;
        }
    }
    }
    </script>



<script>
let cardBox = document.querySelectorAll('.cardbox');
let swipe = document.querySelector('.swipe');
let leftBtn = document.querySelector('#leftBtn')
let rightBtn = document.querySelector('#rightBtn')
// let countBoxes = cardBox.length;
let rightTurn = 0;
let leftTurn = 0;


let pressed = false;
let startx;
let x;
let position = 0;
const positionArray = [];
let movements=[]


document.querySelector('.swipe-cont').addEventListener('mouseenter',function () {
    leftbtnBoundary()
    rightbtnBoundary()
})

document.querySelector('.swipe-cont').addEventListener('mouseleave',function () {
    rightBtn.style.display = 'none';
    leftBtn.style.display = 'none';
})


// SETS INITIAL POSITION FOR THE BOXES
cardBox.forEach((val,i)=>{
    val.style.left += `${position}px`;
    positionArray[i] = position;
    position += 210;
})


if (screen.width>=1000) {
    cardBox.forEach((val,i)=>{
    val.style.transition += '0.5s ease-out';
})
}

// leftbtnBoundary()
// rightbtnBoundary()

leftBtn.addEventListener('click',function() {
if (parseInt(cardBox[0].style.left)<0) {
    rightTurn -= 4
   let value = movements.shift();
    cardBox.forEach((val,index)=>{
    val.style.left = `${positionArray[index]+(210*value)}px`;
  })
  cardBox.forEach((val,index)=>{
    positionArray[index] = parseInt(val.style.left);
  })
}

leftbtnBoundary()
rightbtnBoundary()
})



rightBtn.addEventListener('click',function() {
rightTurn += 4;
if (rightTurn<cardBox.length) {
  if (!(cardBox.length-rightTurn<4)) {
    cardBox.forEach((val,index)=>{
    val.style.left = `${positionArray[index]-210*4}px`;
  })
  movements.push(4);
  cardBox.forEach((val,index)=>{
    positionArray[index] = parseInt(val.style.left);
  })
  }
  else{
    cardBox.forEach((val,index)=>{
    val.style.left = `${positionArray[index]-210*(cardBox.length-rightTurn)}px`;
  })
  cardBox.forEach((val,index)=>{
    positionArray[index] = parseInt(val.style.left);
  })
  movements.push(cardBox.length-rightTurn);
  }
}
else{
    rightTurn -= 4;
}

leftbtnBoundary()
rightbtnBoundary()
})

// EVENT LISTENER FOR TOUCHSTART, INITIALIZES START POSITION
cardBox.forEach((val,i) => {
    cardBox[i].addEventListener('touchstart',function(e) {
startx = e.touches[0].clientX;
})
});


// EVENT LISTENER FOR TOUCHMOVE
cardBox.forEach((val,i) => {
    cardBox[i].addEventListener('touchmove',function(e){
   if (cardBox.length>=3&&screen.width<=630) {
    var touch = e.touches[0];

var change = touch.clientX - startx;

// CHECKS IF THE SWIPE DIRECTION IS FORWARD
if(change<0){
 for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${positionArray[i]+change}px`;
}
rightBoundary();
}

// CHECKS IF THE SWIPE DIRECTION IS BACKWARD
else{
for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${change+positionArray[i]}px`;
}

leftBoundary();
}

e.preventDefault();
   }
   else if (cardBox.length>=5&&screen.width<=1024) {
    var touch = e.touches[0];

var change = touch.clientX - startx;

// CHECKS IF THE SWIPE DIRECTION IS FORWARD
if(change<0){
 for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${positionArray[i]+change}px`;
}
rightBoundary();
}

// CHECKS IF THE SWIPE DIRECTION IS BACKWARD
else{
for (let i = 0; i < cardBox.length; i++) {
cardBox[i].style.left = `${change+positionArray[i]}px`;
}

leftBoundary();
}

e.preventDefault();
   }
})


});


// EVENT LISTENER FOR TOUCHEND
cardBox.forEach((val,i) => {
    cardBox[i].addEventListener('touchend',function(e){
    var change = startx - e.changedTouches[0].clientX

// CHECKS IF THE SWIPE DIRECTION IS FORWARD
   if (change>0) {

// CHECKS IF THE BOX HAS BEEN SWIPED HALFWAY OUT OF THE SCREEN AND IF ITS NOT THE LAST ELEMENT
       if (change>210/2) {
       for (let i = 0; i < positionArray.length; i++) {
            positionArray[i] = parseInt(cardBox[i].style.left);
        }
       }
       // ELSE ROLLBACK TO PREV POSITION
       else{
        for (let i = 0; i < cardBox.length; i++) {
            cardBox[i].style.left = `${positionArray[i]}px`;
        }
       }

   }

// CHECKS IF THE SWIPE DIRECTION IS BACKWARD
   else{
    if (-change>210/2) {
       for (let i = 0; i < positionArray.length; i++) {
            positionArray[i] = parseInt(cardBox[i].style.left);
        }
       }

// ELSE ROLLBACK TO PREV POSITION
     else{
        for (let i = 0; i < cardBox.length; i++) {
            cardBox[i].style.left = `${positionArray[i]}px`;
        }
     }
   }


e.preventDefault();

})


});

function rightbtnBoundary() {
if (parseInt(cardBox[cardBox.length-1].style.left)<=630) {
  rightBtn.style.display = 'none';
}
else{
    rightBtn.style.display = 'block';
}
}

function leftbtnBoundary() {
if (parseInt(cardBox[0].style.left)>=0) {
    leftBtn.style.display = 'none';
}
else{
    leftBtn.style.display = 'block';
}
}

function rightBoundary() {
if (cardBox[cardBox.length-1].getBoundingClientRect().right<swipe.getBoundingClientRect().right) {
   let width = swipe.getBoundingClientRect().width - cardBox[cardBox.length-1].getBoundingClientRect().width - 20;
    for (let k = cardBox.length-1; k >= 0; k--) {
        cardBox[k].style.left = `${width}px`;
        width -= 210;
    }
    cardBox[cardBox.length-1].style.left = `${swipe.getBoundingClientRect().width - cardBox[cardBox.length-1].getBoundingClientRect().width - 20}px`
}
}

function leftBoundary() {
if (parseInt(cardBox[0].style.left)>0) {
   let width = 0;
    for (let k = 0; k < cardBox.length; k++) {
        cardBox[k].style.left = `${width}px`;
        width += 210;
    }
}
}
</script>
