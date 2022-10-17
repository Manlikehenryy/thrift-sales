@include('components.navbar')

<div class="cart-contain">
    <div class="column">
        @if (Auth::check()&&$total_qty)
        <div class="box">
            <div class="header">Cart ({{number_format($total_qty)}})</div>
            @php
            $total_price = 0;
        @endphp
             @foreach ($carts as $cart)
             @php
                 $total_price += $cart->qty * $cart->post->current_amount;
             @endphp
              {{-- <hr> --}}
              <a href="/shop/item/{{$cart->post->id}}">
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
                 <a href="/shop/item/{{$item['item']->id}}">
                    <div class="cart-item">
                       <div class="col">
                         <div class="flex">
                             <img class="cart-img" width="60px" height="60px" src="{{asset('images/'.$item['item']->path)}}" alt="">
                             <div class="cart-text">{{$item['item']->title}}</div>
                         </div>
                         <a class="text-remove" href="{{route('remove.cart.item',$item['item']->id)}}">
                           <img width="25px" class="bin" src="{{asset('images/bin.png')}}" alt="">
                           REMOVE</a>
                       </div>

                       <div class="col relative">
                             <div class="amount">
                               <div  class="curr-amount">{{'₦'.number_format($item['item']->current_amount)}}</div>
                             <div class="old-amount"><strike>{{$item['item']->old_amount?'₦'.number_format($item['item']->old_amount):''}}</strike>
                               <span class={{$item['item']->old_amount?'discount':''}}>{{$item['item']->old_amount? round(((($item['item']->current_amount/$item['item']->old_amount)*100)-100)).'%': ''}}</span>
                           </div>
                             </div>

                       </div>

                       <div class="flex btn-abs">
                           <a href="{{route('decrease.cart.item',$item['item']->id)}}"><button class="btn-minus">-</button></a>
                             <span class="item-qty">{{$item['qty']}}</span>
                             <a href="{{route('store.cart.item',$item['item']->id)}}"><button class="btn-plus">+</button></a>
                         </div>
                     </div>
                   </a>
                @endforeach

            </div>



            <div class="checkout-card">
                <a href="{{route('checkout.cart')}}">
                    <button class="checkout-btn" type="submit">CHECKOUT ({{'₦'.number_format(Session::get('cart')->total_price)}})</button>
                </a>

             </div>
          @endif


    @if (Auth::check()&&$total_qty)
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

      @endif


    </div>



</div>



<style>
    .hide{
        display: none;
    }
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
    width: 60%;
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
 width:30%;
 height: 200px;
 position: fixed;
 /* position: relative; */
 top: 60px;
 right: 40px;
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
  /* flex-direction: row !important; */
  width:100% !important;
  padding: 0 !important;
  background-color: #319595;
}
.column{
    display: flex;
    flex-direction: row;
    margin: 60px 20px 20px 20px;
    margin: 60px auto;
    background: yellow;
   justify-content: center !important;
   /* align-items: center; */
    width:100%;
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
