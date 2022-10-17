<x-admin-master>

    @section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Post</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Post</li>
            </ol>
            <div class="row">
                <div class="col-xl-9 col-md-12">

                            <form class="" action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="title">Select Category</label>
                                    <select name="category" class="form-control" id="">


                                      @foreach ($categories as $category)
                                      @if ($category->id === $post->category_id)
                                      <option value="{{$category->id}}">{{$category->title}}</option>
                                      @break
                                      @endif
                                      @endforeach

                                      @foreach ($categories as $category)
                                      @if ($category->id !== $post->category_id)
                                      <option value="{{$category->id}}">{{$category->title}}</option>
                                      @endif
                                      @endforeach


                                    </select>
                                </div>

                           <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" value="{{$post->title}}" class="form-control" type="text">
                           </div>
                           <div class="form-group">
                            <label for="Description">Description</label>
                            <textarea name="description" class="form-control">
                                {{$post->description?$post->description:''}}
                            </textarea>
                           </div>
                           <div class="form-group">
                            <label for="Amount">Previous Amount <small>optional</small></label>
                            <input name="prev_amount" value="{{$post->old_amount}}" class="form-control" step="5"  type="number">
                           </div>
                           <div class="form-group">
                            <label for="Amount">Current Amount</label>
                            <input name="curr_amount" value="{{$post->current_amount}}" class="form-control" step="5"  type="number">
                           </div>
                           <div class="form-group">
                            <div class="form-group" style="margin-top: 15px;">

                                <img width="200px" height="80px" src={{asset('images/'.$post->path)}} alt="">
                            </div>

                            <br>
                            <input name="image" class="form-control-file" type="file" >
                           </div>

                           <div class="form-group" style="margin-top: 30px;">
                            <label for="image">Additional image <small>Optional</small></label>
                            <div style="margin-bottom: 0px" class="form-group" >
                                 @if ($post->path2)
                                 <img id="path-2" width="200px" height="80px" src={{asset('images/'.$post->path2)}} alt="">
                                 <div style="margin: 10px 0 10px 0"><button onclick="deleteImg(event,<?=$post->id?>,'path2')" id="btn-2" class="btn-size btn-danger">delete</button></div>
                                 @endif

                            </div>


                            <input style="margin-bottom: 20px" name="image2" class="form-control-file" type="file">


                            <div class="form-group" style="margin-top: 15px;margin-bottom: 0px">
                                @if ($post->path3)
                                <img id="path-3" width="200px" height="80px" src={{asset('images/'.$post->path3)}} alt="">
                                <div style="margin: 10px 0 10px 0"><button onclick="deleteImg(event,<?=$post->id?>,'path3')" id="btn-3" class="btn-size btn-danger">delete</button></div>
                                @endif

                           </div>


                           <input name="image3" class="form-control-file" type="file">
                           </div>

                               <br>
                           <button class="btn" type="submit">Submit</button>
                              </form>

                </div>

            </div>


        </div>
    </main>


    @endsection
</x-admin-master>
<style>
    .btn-size{
        border: none;
        border-radius: 5px;
        font-size: 14px;
        padding: 2px 5px;
    }
    a{
            text-decoration: none;
        }
</style>

<script>
            function deleteImg(e,id,path) {
                e.preventDefault();
    // alert('ff')
      $.ajax({
        type: 'GET',
             url: `/admin/post/${id}/delete/image/${path}`,
             success: function (response) {
                alert(response);
                if (path==='path2') {
                  $('#path-2').hide();
                  $('#btn-2').hide();
                }
                else if(path==='path3'){
                    $('#path-3').hide();
                    $('#btn-3').hide();
                }
             }
      })

   }
</script>
