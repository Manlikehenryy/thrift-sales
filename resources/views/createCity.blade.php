<style>
    .form-group{
        margin-bottom: 6px;
    }
    </style>
    <x-admin-master>
        @section('content')

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Create a City</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">City</li>
                </ol>
                @if (Session::has('message'))
                <div class="alert alert-success">
                 {{ Session::get('message')}}
                </div>
                @endif
                <div class="row">
                    <div class="col-xl-9 col-md-12">

                                <form class="" action="{{route('create.city')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Select State</label>
                                        <select name="state_id" class="form-control" id="">

                                          @foreach ($states as $state)
                                          <option value="{{$state->state}}">{{$state->state}}</option>
                                          @endforeach

                                        </select>
                                    </div>

                               <div class="form-group">
                                <label for="city">City</label>
                                <input name="city" class="form-control" type="text" required>
                               </div>

                               <div class="form-group">
                                <label  for="Tier">Tier</label>
                                 <select class="form-control" name="tier" id="">
                                    <option value="TIER1">TIER1</option>
                                    <option value="TIER2">TIER2</option>
                                    <option value="TIER3">TIER3</option>
                                    <option value="TIER4">TIER4</option>
                                 </select>
                               </div>

                               <div class="form-group">
                                <label for="Price">Price</label>
                                <input name="price" class="form-control" step="500"  type="number" required>
                               </div>

                                   <br>
                               <button class="btn btn-primary" type="submit">Submit</button>
                                  </form>

                    </div>

                </div>


            </div>
        </main>


        @endsection
    </x-admin-master>
