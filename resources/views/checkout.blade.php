
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

</head>
<style>
   body{
    background-color: #f2f2f2;
   }
   /* .center{
        position: relative;
        top: 50%;
        left: 50%;
        transform: translateX(-50%);
        width:100%;
    } */
    .card{
        width: 30%;
        /* height: 80px; */
        top: 15%;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
        /* margin: 20px;*/
        padding: 20px;
    }
    .flex{
        display: flex !important;
        flex-direction: row;
        justify-content: space-between;
    }
    @media(max-width:991px){
        .card{
        width: 80%;
    }

    }
</style>
<body>
    <div class="center" >
        <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
            @csrf

          <div class="card">
            <img  style="" width="200px" height="111.11px" src="{{asset('images/paystack.png')}}" alt="">

           <button style="" class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
               <i class="fa fa-plus-circle fa-lg"></i> Pay Now {{'₦'.number_format($total_price)}}
           </button>

       </div>

       </form>

    </div>

</body>
</html>
