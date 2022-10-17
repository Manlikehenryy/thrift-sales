<x-admin-master>
    @section('content')
<style>
    .btn-size{
        border: none;
        border-radius: 5px;

    }
    a{
            text-decoration: none;
        }
</style>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">All Cities</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">City</li>
            </ol>
            @if (Session::has('message'))
            <div class="alert alert-success">
             {{ Session::get('message')}}
            </div>
            @endif

            @if (Session::has('danger'))
            <div class="alert alert-danger">
             {{ Session::get('danger')}}
            </div>
            @endif

            <div class="card mb-4">

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($cities as $city)
                            <tr>
                                <td>{{$count += 1}}</td>
                                <td>{{$city->city}}</td>
                                  <td>{{$city->state_id}}</td>
                                <td>{{$city->created_at->diffForHumans()}}</td>
                                <td>{{$city->updated_at->diffForHumans()}}</td>
                                <td><a href="{{route('edit.city',$city->id)}}">Edit</a></td>
                                <td>
                                    <form class="delete" action="{{route('destroy.city',$city->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                     <button class="btn-size btn-danger" type="submit">delete</button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    @endsection

</x-admin-master>
