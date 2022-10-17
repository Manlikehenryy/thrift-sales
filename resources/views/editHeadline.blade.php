<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
#zo:focus{
 outline: none;
}
</style>
<x-admin-master>
    @section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Headline</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Headline</li>
            </ol>

            <div class="row">
                <div class="col-xl-9 col-md-12">
                  <form class="" action="{{route('headline.update',$headline->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                   <div class="form-group">
                    <label for="title">Headline Title</label>
                    <input name="title" value="{{$headline->title}}" class="form-control" type="text">
                   </div>

                   <div class="form-group">
                    <label for="title">Select one or more Post</label>

                    @foreach ($posts as $post)
                    <div class="form-group">
                        <input type="checkbox" id="{{'post-'.$post->id}}" name="{{ str_ireplace(' ','',$post->title).$post->id}}" value="{{$post->id}}">
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


<script>
    id = @php echo $headline->id; @endphp;
$.ajax({
    url:`/admin/headline/${id}/fetch`,
    type:'GET',
    success:function(data){
      data.forEach(el => {
       document.querySelector(`${'#post-'+el.post_id}`).checked = true;
      });;
    }
})
</script>

