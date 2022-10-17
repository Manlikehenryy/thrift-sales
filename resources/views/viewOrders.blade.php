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
                                <th>Account name</th>
                                <th>Payment ID</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Recipient</th>
                                <th>Phone no</th>
                                <th>Amount</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>View items</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Account name</th>
                                <th>Payment ID</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Recipient</th>
                                <th>Phone no</th>
                                <th>Amount</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>View items</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($orders as $order )
                            <tr>
                                <td>{{$count += 1}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->payment_id}}</td>
                                <td><select onchange="myfunc({{$order->id}})" name="status" id="status">
                                    @if ($order->status==='Delivery in Progress')
                                    <option value="Delivered">Delivered</option>
                                    <option value="{{$order->status}}" selected>{{$order->status}}</option>
                                    @else
                                    <option value="Delivery in Progress">Delivery in Progress</option>
                                    <option value="{{$order->status}}" selected>{{$order->status}}</option>
                                    @endif

                                </select></td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->recipient}}</td>
                                <td>{{$order->phone_no}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{$order->city}}</td>
                                <td>{{$order->state}}</td>
                                <td>{{$order->created_at->diffForHumans()}}</td>
                                <td>{{$order->updated_at->diffForHumans()}}</td>
                                <td><a href="{{route('admin.view.order.details',$order->id)}}">View items</a></td>
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

<script>
            function myfunc(id) {
      $.ajax({
        type: 'GET',
             url: `/update/status/${id}/${$('#status').val()}`,
             success: function (response) {
                alert(response);
             }
      })

   }
</script>
