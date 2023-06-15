<x-master-admin>
@section('content')
        <h1 class="h3 mb-4 text-gray-800">Create Post</h1>

        <form method="POST" action="{{route('admin.posts.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="PostTile">Title</label>
                <input type="text" class="form-control"  name = "title" aria-describedby="emailHelp" placeholder="Enter Title">

            </div>
            <div class="form-group">
                <label for="PostBody">Content</label>
                <textarea type="text" class="form-control "  name="body" placeholder="Enter Content" rows="15" cols="50"   ></textarea>
            </div>
           
            <div class="form-group">
                <label for="exampleFormControlFile1">Post Image</label>
                <input type="file" class="form-control-file" name = "post_image" >
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif

    @endsection



</x-master-admin>