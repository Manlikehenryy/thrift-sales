<x-admin-master>
    @section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create a Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>
           @if (Session::has('message'))
           <div class="alert alert-success">
            {{ Session::get('message')}}
           </div>
           @endif

            <div class="row">
                <div class="col-xl-9 col-md-12">
                  <form class="" action="{{route('category.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                   <div class="form-group">
                    <label for="title">Category Title</label>
                    <input name="title" class="form-control" type="text" required>
                   </div>

                   <div class="form-group">
                    <label for="photo">Category Photo</label>
                    <input name="photo" class="form-control" type="file" required>
                   </div>

                   <button class="btn btn-primary" type="submit">Submit</button>
                  </form>
                </div>

            </div>


        </div>
    </main>


    @endsection
</x-admin-master>
