<x-master-admin>
    @section('content')
 

        <h1 class="h3 mb-4 text-gray-800">All Users</h1>

        @if(Session::get('message'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('message')}}
            </div>
  
        @elseif(Session::has('message-user-updated'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message-user-updated')}}
        </div>
        @endif

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Id</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td><a href="{{route('user.profile.show',['user'=>$user])}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td><img src = '{{$user->profile_image}}' width= '300px'></img></td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <form method='post' action="{{route('user.profile.delete',['user'=>$user])}}">
                            @csrf
                            <td><button type='submit' class='btn btn-danger btn-sm'  >Delete</button></td>
                        </form>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


        
    @endsection

    @section ('scripts')
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts --> 
         <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection


</x-master-admin>