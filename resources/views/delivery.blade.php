
@include('components.navbar')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    .modal{
        width: 60%;
       box-shadow: 0 0 45px rgba(0, 0, 0, 0.2);
       padding: 15px 30px 15px 30px;
       position: fixed;
       top: 0px;
       left: 50%;
       transform: translateX(-50%);
       background-color: #fff ;
    }

    .delivery-form{
       width: 60%;
       box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
       padding: 30px 30px 90px 30px;
       position: relative;
       top: 90px;
       left: 50%;
       transform: translateX(-50%);
       background-color: #fff ;
    }
    .card-box{
        width: 60%;
       box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
       padding: 30px 45px 90px 45px;
       position: relative;
       left: 50%;
       transform: translateX(-50%);
       background-color: #fff ;
    }
    .details{
        width: 60%;
       box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
       padding: 30px 45px 30px 45px;
       position: relative;
       top: 90px;
       left: 50%;
       transform: translateX(-50%);
       background-color: #fff ;
    }

    h4.head{
        font-size: 18px;
        font-weight: 700;
        margin-left: 10px;
    }
    h3.head{
        font-size: 18px;
        font-weight: 700;
        /* margin-left: 10px; */
    }
    div.form-group{
     display: flex;
     flex-direction: column;
     margin: 20px 10px;
    }
    div.flex{
        display: flex;
    }
    label{
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 600;
        color: rgb(108, 108, 108);
    }
    .btn{
        width: 87%;
        height: 40px;
        border-radius: 6px;
        color: #fff;
        background-color: #4FA8A8;
        border: none;
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%)
    }
        body{
            background-color: #f2f2f2 !important;
        }
        .flex-text{
            display: flex;
            justify-content: space-between;
        }
        .orders{
          margin-bottom: 40px;
        }
        #edit{
            position: absolute;
            right: 30px;
            top: 30px;
            color: #4FA8A8 !important;
            font-weight: 600;
        }
        .qty{
            margin: 0 20px 20px 0;
        }
        .total{
           margin-top: 20px;
           font-weight: 700;
        }
        .total-price{
            color: #4FA8A8;
            font-size: 18px;
        }
        .btn:hover{
         color: #fff;
        }

        .exit{
            position: fixed;
            top: -1%;
            right: 30px;
            font-size: 43px;
            transform: rotate(45deg);
            cursor: pointer;
        }
      @media(max-width:991px){
        *{
            font-size: 14px;
        }
        .delivery-form,.details,.modal,.card-box{
       width: 90%;
    }
      }

</style>

<div class="container">

    @if ($address)
    <div class="details">
    <h3 class="head">ADDRESS DETAILS</h3>
    <a id="edit" href="">CHANGE </a>
    <div>{{$address->firstname.' '.$address->lastname}}</div>
    <div>{{$address->address}}</div>
    <div>{{$address->phoneno}}</div>

    </div>


    @else

    @if (Session::has('message'))
    <div class="alert alert-danger">{{Session::get('message')}}</div>
    @endif

    {{-- FORM FOR CREATING A NEW ADDRESS --}}

    <form class="delivery-form" action="/create/address" method="post" enctype="multipart/form-data">
       @csrf
       <h4 class="head">ADDRESS DETAILS</h4>

       <div style="width: 100%;" class="flex">
       <div style="width: 50%;" class="form-group">
         <label for="FirstName">First Name</label>
        <input style="width: 100%;" type="text" value="{{Auth::user()->first_name}}" name="FirstName" id="">
    </div>
    <div style="width: 50%;" class="form-group">
        <label for="LastName">Last Name</label>
       <input style="width: 100%;" type="text" value="{{Auth::user()->last_name}}" name="LastName" id="">
    </div>
       </div>

       <div class="form-group">
        <label for="Phonenumber">Phone number</label>
       <input type="text" name="Phonenumber" id="">
      </div>

       <div class="form-group">
          <label for="Address">Delivery Address</label>
         {{-- <input  id=""> --}}
         <textarea type="text" name="Address" id="" ></textarea>
        </div>




      <div class="form-group">
        <label for="state">State/Region</label>
        <select name="state" id="state">
            <option value="">Please select...</option>
         @foreach ($states as $state)
         <option value="{{$state->state}}">{{$state->state}}</option>
         @endforeach
         </select>
      </div>

     <div class="form-group">
        <label for="city">City</label>
        <select name="city" id="city">
            <option value="">Please select...</option>
        </select>
     </div>

       <input class="btn" type="submit" value="SAVE ADDRESS">
    </form>

    @endif

<br><br><br><br><br>

<div class="card-box">
<h3 class="head">ORDER DETAILS</h3>

<div class="orders">
    @foreach ($carts as $cart)
<div class=""><span class="qty">{{$cart->qty}}x</span><span class="qty">{{$cart->post->title}}</span></div>
@endforeach
</div>

<div class="flex-text"><div>Subtotal</div><div>{{'₦'.number_format($total_price)}}</div></div>

{{-- under condition --}}
@if ($address)
<div class="flex-text"><div>Delivery fee</div><div>{{'₦'.number_format($price)}}</div></div>
<div class="flex-text total"><div>Total</div><div class="total-price">{{'₦'.number_format($price+$total_price)}}</div></div>

    <form action="{{route('checkout')}}" method="post">
        @csrf
    <input class="btn" type="submit" value="PROCEED TO PAY">
    </form>
@endif


</div>


<br><br><br><br><br><br>
</div>








@if ($address)
<div id="address-form"  class="modal">

    <form class="update" action="/update/address/{{$address->id}}" method="post" enctype="multipart/form-data">

        @csrf
        @method('PATCH')

    @if (Session::has('message'))
      <a href="/link">{{Session::get('message')}}</a>

    @endif

    <h4 class="head">ADDRESS DETAILS</h4>
    <div class="exit">+</div>
    <div style="width: 100%;" class="flex">
    <div style="width: 50%;" class="form-group">
      <label for="FirstName">First Name</label>
     <input style="width: 100%;" type="text" value="{{$address->firstname}}" name="FirstName" id="">
 </div>
 <div style="width: 50%;" class="form-group">
     <label for="LastName">Last Name</label>
    <input style="width: 100%;" type="text" value="{{$address->lastname}}" name="LastName" id="">
 </div>
    </div>

    <div class="form-group">
     <label for="Phonenumber">Phone number</label>
    <input type="text" value="{{$address->phoneno}}" name="Phonenumber" id="">
   </div>

     <div class="form-group">
       <label for="Address">Delivery Address</label>
      {{-- <input  id=""> --}}
      <textarea type="text" name="Address" id="" >{{$address->address}}</textarea>
     </div>




   <div class="form-group">
     <label for="state">State/Region</label>
      <select name="state" id="state">
        <option value="">Please select...</option>


     @foreach ($states as $state)
     @if ($state->state!=$address->state)
     <option value="{{$state->state}}">{{$state->state}}</option>
     @else
     <option selected="selected" value="{{$state->state}}">{{$state->state}}</option>
     @endif
     @endforeach
     </select>
   </div>

  <div class="form-group">
     <label for="city">City</label>
     <select name="city" id="city">
        <option value="">Please select...</option>
        @foreach ($cities as $city)
       @if ($city->city != $address->city)
       <option value="{{$city->city}}">{{$city->city}}</option>
       @else
       <option selected="selected" value="{{$city->city}}">{{$city->city}}</option>
       @endif
        @endforeach

    </select>
  </div>

    <input class="btn" type="submit" value="SAVE ADDRESS">


    </form>
</div>

@endif

@include('components.footer')

<script>
    $(document).ready(function () {
        $('.exit').click(function () {
            $('.modal').hide();
        })

      $('#address-form').hide()
       $('#edit').click(function (e) {
        e.preventDefault();
        $('#address-form').show();
       })

      $('#state').change(function () {
           $('#city').empty();
           let html;
           html = `<option value="">Loading...</option>`
           $('#city').append(html);
           var state = $(this).val();
           $.ajax({
             type: 'GET',
             url: `/get/cities/${state}`,
             dataType:'Json',
             success: function (response) {
              populate(response);
             }
           })


           function populate(data) {
            $('#city').empty();
            html = `<option value="">please select...</option>`
             data.forEach(val => {
              html += `<option value="${val.city}">${val.city}</option>`
             });

             $('#city').append(html);
           }
      })

    })
</script>
