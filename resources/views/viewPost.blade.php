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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Posted by</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Posted by</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($posts as $post )
                            <tr>
                                <td>{{$count += 1}}</td>
                                <td>{{$post->title}}</td>
                                {{-- @foreach ($categories as $category)
                                 {{-- @if ($category->id === $post->category_id) --}}
                                  @if ($post->category?->title==null)
                                  <td>{{'This category was deleted'}}</td>
                                  @else
                                  <td>{{$post->category->title}}</td>
                                  @endif





                                 {{-- @break
                                 @endif
                                @endforeach --}}
                                <td><img width="100px" height="50px" src={{asset('images/'.$post->path)}} alt=""></td>
                                @foreach ($users as $user)
                                @if ($user->id === $post->user_id and Auth::user()->id === $post->user_id)
                                <td>me</td>
                                @break
                                @elseif ($user->id === $post->user_id)
                                <td>{{$user->first_name.' '.$user->last_name}}</td>
                                @break
                                @endif
                               @endforeach

                                <td>{{$post->created_at->diffForHumans()}}</td>
                                <td>{{$post->updated_at->diffForHumans()}}</td>
                                <td><a href="{{route('post.edit',$post->id)}}">Edit</a></td>
                                <td>
                                    <form class="delete" action="{{route('post.destroy',$post->id)}}" method="post">
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
