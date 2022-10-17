<style>
.form-group{
    margin-bottom: 6px;
}
</style>
<x-admin-master>
    @section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create a Post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Post</li>
            </ol>
            @if (Session::has('message'))
            <div class="alert alert-success">
             {{ Session::get('message')}}
            </div>
            @endif
            <div class="row">
                <div class="col-xl-9 col-md-12">
                            <form class="" action="{{route('post.create')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Select Category</label>
                                    <select name="category" class="form-control" id="">

                                      @if (count($categories) !== 0)
                                      @foreach ($categories as $category)
                                      <option value="{{$category->id}}">{{$category->title}}</option>
                                      @endforeach
                                      @else
                                      <option value="">{{__('no category available')}}</option>
                                      @endif


                                    </select>
                                </div>

                           <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" class="form-control" type="text" required>
                           </div>
                           <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea name="description" class="form-control">
                            </textarea>
                           </div>
                           <div class="form-group">
                            <label for="Amount">Previous Amount <small>optional</small></label>
                            <input name="prev_amount" class="form-control" step="5"  type="number">
                           </div>
                           <div class="form-group">
                            <label for="Amount">Current Amount</label>
                            <input name="curr_amount" class="form-control" step="5"  type="number" required>
                           </div>
                           <div class="form-group">
                            <label for="title">Upload image</label>
                            <br>
                            <input name="image" class="form-control" type="file" required>
                           </div>
                           <div class="form-group">
                            <label for="title">Additional image <small>Optional</small></label>
                            <br>
                          <div class="form-group">
                            <input name="image2" class="form-control" type="file">
                        </div>
                           <div class="form-group">
                            <input name="image3" class="form-control" type="file">
                           </div>
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
