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
            <h1 class="mt-4">All Headlines</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Headline</li>
            </ol>


            <div class="card mb-4">

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>No of Posts</th>
                                <th>created by</th>
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
                                <th>No of Posts</th>
                                <th>created by</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($headlines as $headline)

                            <tr>
                                <td>{{$count += 1}}</td>
                                <td>{{$headline->title}}</td>

                                <td>{{count($headline->posts)}}</td>
                                @foreach ($users as $user)
                                @if (Auth::check() and Auth::user()->id === $headline->user_id)
                                <td>me</td>
                                @break
                                @elseif ($user->id === $headline->user_id)
                                <td>{{$user->first_name.' '.$user->last_name}}</td>
                                @break
                                @endif
                               @endforeach

                                <td>{{$headline->created_at->diffForHumans()}}</td>
                                <td>{{$headline->updated_at->diffForHumans()}}</td>
                                <td><a href="{{route('headline.edit',$headline->id)}}">Edit</a></td>
                                <td>
                                    <form class="delete" action="{{route('headline.destroy',$headline->id)}}" method="post">
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
