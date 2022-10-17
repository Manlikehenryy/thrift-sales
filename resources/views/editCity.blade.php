<x-admin-master>
    @section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit City</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">City</li>
            </ol>
            <div class="row">
                <div class="col-xl-9 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="" action="{{route('update.city',$city->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                           <div class="form-group">
                            <label for="title">City</label>
                            <input name="city" value="{{$city->city}}" class="form-control" type="text" required>
                           </div>
                           <div class="form-group">
                            <label for="Amount">State</label>
                            <select class="form-control" name="state_id" id="">
                                @foreach ($states as $state)
                                 @if ($state->state === $city->state_id)
                                <option value="{{$city->state_id}}" selected>{{$city->state_id}}</option>
                                @else
                                <option value="{{$state->state}}">{{$state->state}}</option>
                                 @endif
                                @endforeach
                            </select>
                           </div>

                           <div class="form-group">
                            <label for="Tier">Tier </label>
                          <select class="form-control" name="tier" id="">
                            @foreach ($tiers as $tier )
                            @if ($tier === $city->tier)
                            <option value="{{$city->tier}}" selected>{{$city->tier}}</option>
                            @else
                            <option value="{{$tier}}">{{$tier}}</option>
                            @endif
                          @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                            <label for="Price">Price</label>
                            <input name="price" value="{{$city->price}}" class="form-control" type="text" required>
                           </div>

                               <br>
                           <button class="btn btn-primary" type="submit">Submit</button>
                              </form>
                        </div>
                     </div>
                </div>

            </div>


        </div>
    </main>


    @endsection
</x-admin-master>
