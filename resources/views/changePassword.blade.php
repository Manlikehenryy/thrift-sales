@include('components.navbar')
<style>
        footer{
        position: absolute;
        bottom: 0px;
        left: 0;
        width: 100%;
        height: 30px;
    }

    body{
        background-color: #f2f2f2 !important;
        height: 110vh;
        position: relative;
    }
    form{
        position: absolute;
        top: 24%;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        padding: 40px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        background-color: #fff;
    }
    .alert{
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
    }
    input[type="submit"]{
        background: #4FA8A8;
        border: 3px solid #4FA8A8;
        border-radius: 5px;
        color: #fff;
        margin-top: 30px;
    }
    label{
        margin-bottom: 5px;
    }
    .form-group{
      margin-bottom: 10px;
    }
    input:focus{
        outline: 3px solid #4FA8A8 !important;
        border: none !important;
    }
    input[type="submit"]:focus{
        background: #4FA8A8;
        border: none !important;
        outline: none !important;
        border-radius: 5px;
        color: #fff;
        margin-top: 30px;
    }
    @media(max-width:768px){
        form{
        width: 90%;
    }
    }
</style>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif


    @if (Session::has('message'))
    <div class="alert alert-success">
        {{Session::get('message')}}
       </div>
    @endif

    @if (Session::has('danger'))
    <div class="alert alert-danger">
     {{Session::get('danger')}}
    </div>
    @endif

<form action="{{route('change.password')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="prev password">Current password</label>
        <input class="form-control"  type="password" name="prev_password" required>
    </div>

      <div class="form-group">
        <label for="new password">New password</label>
        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </div>

        <div class="form-group">
            <label for="confirm password">Confirm password</label>
            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required>

            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <input type="submit" class="form-control" value="Change password">
</form>
@include('components.footer')
