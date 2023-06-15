<x-master-admin>
    @section('content')
    <h1 class="h3 mb-4 text-gray-800">User Profile for {{$user->name}}</h1>
    @if(session('message-role-attach'))
        <div class="alert alert-success">
            {{session('message-role-attach')}}
        </div>
        @endif
        @if(session('message-role-detach'))
        <div class="alert alert-danger">
            {{session('message-role-detach')}}
        </div>
        @endif

    <form method="POST" action="{{route('user.profile.update',['user'=>$user])}}" enctype="multipart/form-data">
            @csrf
            <div>
                <img class="img-profile rounded-circle m-3" width=200px; src="{{$user->profile_image}}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">Profile Image</label>
                <input type="file" class="form-control-file" name = "profile_image"  >
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror"  name = "username" value="{{$user->username}}" >
                @error('username')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="PostTile">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"  name = "name" value="{{$user->name}}" >
                @error('name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="PostTile">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror"  name = "email" value="{{$user->email}}"  >
                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="PostTile">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"  name = "password"  >
                @error('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="PostTile">Confirm Password</label>
                <input type="password" class="form-control @error('confirm-password') is-invalid @enderror"  name = "confirm-password"  >
                @error('confirm-password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

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
                    @foreach ($roles as $role)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                @foreach($user->roles as $role_user )  
                                @if ($role_user->name== $role->name)
                                checked
                                @endif
                                @endforeach
                                >
                            </div>
                        </td>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <form method="post" action="{{route('user.role.attach',['user'=>$user])}}">
                                @csrf
                                <input type = "hidden" name="role" value="{{$role->id}}" />
                                <button type="submit" class="btn btn-primary"
                                    @if ($user->roles->contains($role))
                                    disabled
                                        @endif
                    
                                >Attach</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="{{route('user.role.detach',['user'=>$user])}}">
                                @csrf
                                <input type = "hidden" name="role" value="{{$role->id}}" />
                                <button type="submit" class="btn btn-danger" 
                 
                                    @if (!$user->roles->contains($role))
                                        disabled
                                    @endif
                              
                                >Detach</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
    
    @endsection
</x-master-admin>