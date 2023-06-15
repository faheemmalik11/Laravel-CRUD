<x-master-admin>
    @section('content')

    @if(session('role-updated'))
    <div class="alert alert-success">
        {{session('role-updated')}}
    </div>
    @endif

    @if(session('message-permission-attach'))
        <div class="alert alert-success">
            {{session('message-permission-attach')}}
        </div>
        @endif
        @if(session('message-permission-detach'))
        <div class="alert alert-danger">
            {{session('message-permission-detach')}}
        </div>
        @endif




        <!-- DataTales Example -->
        <div class="input-group ">
            <div class="form-outline ">
                <form method= "post" action="{{route('role.update',['role'=>$role])}}">
                    @csrf
                    <input type="text"   name="name" value="{{$role->name}}"   class="form-control @error('name') is-invalid @enderror" />  
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                        <button type="submit" class="btn btn-primary float-right my-2">Update</button>
                </form>
            </div>

 
  


       <div class="card shadow mx-auto">
        
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
            </div>

            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Option</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Attach</th>
                        <th>Detach</th>
                    </tr>
                  </thead>
                  <tfoot>
                  <tr>
                        <th>Option</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Attach</th>
                        <th>Detach</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                @foreach($role->permissions as $permission_role )  
                                @if ($permission_role->name== $permission->name)
                                checked
                                @endif
                                @endforeach
                                >
                            </div>
                        </td>
                        <td>{{$permission->id}}</td>
                        <td>{{$permission->name}}</td>
                        <td>
                            <form method="post" action="{{route('role.permission.attach',['role'=>$role])}}">
                                @csrf
                                <input type = "hidden" name="permission" value="{{$permission->id}}" />
                                <button type="submit" class="btn btn-primary"
                                    @if ($role->permissions->contains($permission))
                                    disabled
                                        @endif
                    
                                >Attach</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{route('role.permission.detach',['role'=>$role])}}">
                                @csrf
                                <input type = "hidden" name="permission" value="{{$permission->id}}" />
                                <button type="submit" class="btn btn-danger" 
                 
                                    @if (!$role->permissions->contains($permission))
                                        disabled
                                    @endif
                              
                                >Detach</button>
                            </form>
                        </td>
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