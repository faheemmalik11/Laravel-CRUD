<x-master-admin>
    @section('content')

    @if(session('role-deleted'))
    <div class="alert alert-danger">
        {{session('role-deleted')}}
    </div>
    @endif

    @if(session('role-created'))
    <div class="alert alert-success">
        {{session('role-created')}}
    </div>
    @endif



        <!-- DataTales Example -->
        <div class="input-group ">
            <div class="form-outline ">
                <form method= "post" action="{{route('role.add')}}">
                    @csrf
                    <input type="text"  name="name"  class="form-control @error('name') is-invalid @enderror" />  
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                        <button type="submit" class="btn btn-primary float-right my-2">Add Role</button>
                </form>
            </div>

 
  


       <div class="card shadow mx-auto">
        
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Id</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td><a href="{{route('role.edit',['role'=>$role])}}">{{$role->name}}</a></td>
                        <td>{{$role->created_at->diffForHumans()}}</td>
                        <td>{{$role->updated_at->diffForHumans()}}</td>
                        <form method='post' action="{{route('role.delete',['role'=>$role])}}">
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
</div>

        
    @endsection

    @section ('scripts')
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts --> 
         <!-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> -->
    @endsection




</x-master-admin>