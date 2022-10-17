<x-admin-master>
    @section('content')
<style>

</style>


    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create an Admin</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">User</li>
            </ol>
           @if (Session::has('message'))
           <div class="alert alert-success">
            {{ Session::get('message')}}
           </div>
           @endif

            <div class="row">
                <div class="col-xl-9 col-md-12">
                    <form method="POST" action="{{ route('admin.create.admin') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-md-12 col-form-label ">{{ __('First Name') }}</label>


                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-12 col-form-label">{{ __('Last Name') }}</label>


                                <input id="last_name" type="text" class="form-control"  name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email Address') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                {{-- @if (Session::has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{Session::get('email')}}</strong>
                                </span>
                                @endif --}}

                        </div>

                        <div class="form-group">
                            <label for="phone_no" class="col-md-12 col-form-label">Phone Number&nbsp;&nbsp;<small>optional</small></label>


                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" autocomplete="phone_no" autofocus>

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-12 col-form-label ">{{ __('Password') }}</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12 col-form-label ">{{ __('Confirm Password') }}</label>


                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  required autocomplete="new-password">

                        </div>

                        <div class="form-group">

                                <button class="form-control" type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>

                        </div>
                    </form>
                </div>

            </div>


        </div>
    </main>


    @endsection
</x-admin-master>

