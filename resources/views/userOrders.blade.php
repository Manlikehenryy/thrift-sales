
@include('components.navbar')
<style>
    .col{
        display: flex;
        flex-direction: column;
        padding-top: 5px;
    }
    .flex{
      display: flex;
      border: 1px solid rgb(225, 225, 225);
      margin: 10px;
      height: 100px;
    }
    .box-container{
        width: 60%;
        /* position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 20%; */
        margin-left: 40px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);
    }
    footer{
        /* position: absolute;
        bottom: 0px;
        left: 0; */
        width: 100%;
    }
    .img{
        margin: 10px;
    }
    .status{
        width: 142px;
        height: 22px;
        font-size: 14px;
        background-color: #648282;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        /* margin-top: 30px; */
    }
    .success{
        width: 72px;
        height: 22px;
        background-color: rgb(40, 184, 40);
        font-size: 14px;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        /* margin-top: 30px; */
    }
    hr{
        background-color: rgb(159, 157, 157);
    }
    .order-head{
      font-weight: 600;
      font-size: 20px;
      padding: 10px 0 0 10px;
    }
    .ro{
        display: flex !important;
        margin: 5px 0;
    }
     .date{
        margin: 0 10px;
     }
</style>

@if (count($orders))
<br><br><br>
<div class="box-container">
    <div class="order-head">Orders</div>
    <hr>
    @php
    foreach($orders as $order){
    $cart_items = unserialize($order->posts);

@endphp


@foreach ($cart_items as $cart)
<div class="flex">
<img class="img" width="80px" height="80px" src="{{asset('images/'.$cart['path'])}}" alt="">
<div class="col">
<div>{{$cart->title}}&nbsp;&nbsp;&nbsp;{{'x'.$cart->qty}}</div>
<div class="ro">
    <div class="price">{{'₦'.number_format($cart->price)}}</div>
</div>
<div class="ro"><div class="@if ($order->status === 'Delivered') success @else status @endif">{{$order->status}}</div>
 <div class="date">{{$order->status === 'Delivered'? 'On '.substr($order->updated_at,0,10):substr($order->created_at,0,10)}}</div>
</div>
</div>
</div>
@endforeach
@php
    }
@endphp
</div>
@else
<h1 class="text-center" style="position:absolute;top:20%;">There are no orders!</h1>
    @endif


    @include('components.footer')
