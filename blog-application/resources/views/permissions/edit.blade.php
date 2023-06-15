<x-master-admin>
    @section('content')
    <h1>Edit Permission</h1>

    @if(session('permission-updated'))
    <div class="alert alert-success">
        {{session('permission-updated')}}
    </div>
    @endif




        <!-- DataTales Example -->
        <div class="input-group ">
            <div class="form-outline ">
                <form method= "post" action="{{route('permission.update',['permission'=>$permission])}}">
                    @csrf
                    <input type="text"   name="name" value="{{$permission->name}}"   class="form-control @error('name') is-invalid @enderror" />  
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                        <button type="submit" class="btn btn-primary float-right my-2">Update</button>
                </form>
            </div>

    @endsection
</x-master-admin>