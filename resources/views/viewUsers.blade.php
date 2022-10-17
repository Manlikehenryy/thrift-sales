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
            <h1 class="mt-4">All Posts</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Post</li>
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
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone no</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone no</th>
                                <th>Created</th>
                                <th>Updated</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$count += 1}}</td>
                                <td>{{$user->first_name}}</td>
                                {{-- @foreach ($categories as $category)
                                 {{-- @if ($category->id === $post->category_id) --}}

                                  <td>{{$user->last_name}}</td>





                                 {{-- @break
                                 @endif
                                @endforeach --}}
                                <td>{{$user->role}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone_no?$user->phone_no:'nil'}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>{{$user->updated_at->diffForHumans()}}</td>

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
