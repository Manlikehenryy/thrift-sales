<x-admin-master>
    @section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create a Headline</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Headline</li>
            </ol>
           @if (Session::has('message'))
           <div class="alert alert-success">
            {{ Session::get('message')}}
           </div>
           @endif

            <div class="row">
                <div class="col-xl-9 col-md-12">
                  <form class="" action="{{route('Headline.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                   <div class="form-group">
                    <label for="title">Headline Title</label>
                    <input name="title" class="form-control" type="text">
                   </div>

                   <div class="form-group">
                    <label for="title">Select one or more Post</label>

                    @foreach ($posts as $post)
                    <div class="form-group">
                        <input type="checkbox" name="{{$post->title.$post->id}}" value="{{$post->id}}">
                        <label for="{{$post->title}}">{{$post->title}}</label>
                    </div>
                    @endforeach
                   </div>

                   <button class="btn btn-primary" type="submit">Submit</button>
                  </form>
                </div>

            </div>


        </div>
    </main>


    @endsection
</x-admin-master>
