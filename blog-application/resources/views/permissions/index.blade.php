<x-master-admin>
    @section('content')

    <x-master-admin>
    @section('content')

    @if(session('permission-deleted'))
    <div class="alert alert-danger">
        {{session('permission-deleted')}}
    </div>
    @endif

    @if(session('permission-created'))
    <div class="alert alert-success">
        {{session('permission-created')}}
    </div>
    @endif



        <!-- DataTales Example -->
        <div class="input-group ">
            <div class="form-outline ">
                <form method= "post" action="{{route('permission.add')}}">
                    @csrf
                    <input type="text"  name="name"  class="form-control @error('name') is-invalid @enderror" />  
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                        <button type="submit" class="btn btn-primary float-right my-2">Add permission</button>
                </form>
            </div>

 
  


       <div class="card shadow mx-auto">
        
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">permissions</h6>
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
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{$permission->id}}</td>
                        <td><a href="{{route('permission.edit',['permission'=>$permission])}}">{{$permission->name}}</a></td>
                        <td>{{$permission->created_at->diffForHumans()}}</td>
                        <td>{{$permission->updated_at->diffForHumans()}}</td>
                        <form method='post' action="{{route('permission.delete',['permission'=>$permission])}}">
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
        
    @endsection

</x-master-admin>