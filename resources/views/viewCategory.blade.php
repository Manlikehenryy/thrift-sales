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
            <h1 class="mt-4">All Categories</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
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
                                <th>Title</th>
                                <th>Image</th>
                                <th>No of Posts</th>
                                <th>Posted by</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>No of Posts</th>
                                <th>Posted by</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($categories as $category)


                            <tr>
                                <td>{{$count += 1}}</td>
                                <td>{{$category->title}}</td>
                                <td><img width="100px" height="50px" src={{asset('images/'.$category->path)}} alt=""></td>
                                <td>{{count($category->posts)}}</td>
                                @foreach ($users as $user)
                                @if (Auth::check() and Auth::user()->id === $category->user_id)
                                <td>me</td>
                                @break
                                @elseif ($user->id === $category->user_id)
                                <td>{{$user->first_name.' '.$user->last_name}}</td>
                                @break
                                @endif
                               @endforeach

                                <td>{{$category->created_at->diffForHumans()}}</td>
                                <td>{{$category->updated_at->diffForHumans()}}</td>
                                <td><a href="{{route('category.edit',$category->id)}}">Edit</a></td>
                                <td>
                                    <form class="delete" action="{{route('category.destroy',$category->id)}}" method="post">
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
