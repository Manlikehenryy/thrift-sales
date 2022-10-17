<x-admin-master>
    @section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category</li>
            </ol>
            <div class="row">
                <div class="col-xl-9 col-md-12">
                  <form class="" action="{{route('category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                   <div class="form-group">
                    <label for="title">Category Title</label>
                    <input name="title" value="{{$category->title}}" class="form-control" type="text">
                   </div>

                   <div class="form-group">
                    <div class="form-group" style="margin-top: 15px;">
                        <img width="200px" height="80px" src={{asset('images/'.$category->path)}} alt="">
                    </div>

                    <br>
                    <input name="photo" class="form-control-file" type="file">
                   </div>

                   <button class="btn btn-primary" type="submit">Submit</button>
                  </form>
                </div>

            </div>


        </div>
    </main>


    @endsection
</x-admin-master>
