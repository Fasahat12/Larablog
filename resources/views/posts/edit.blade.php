<x-layout :$pageTitle>
    <div class='row mb-5 pb-5'>
      <div class="col-md-8 col-lg-6 col-10 mx-auto mt-4">
        <div class='card shadow border-0'>
            <div class="card-body">
                <form action="/post/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <h3 class='text-center mb-4'>Edit Post</h3>
                    <div class="mb-3">
                        <label for="image" class="fw-bold">Image</label>
                        <input name="image" class="form-control" type="file" id="image">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror
                        <img src="{{ asset('storage/'.$post->image) }}" class="img-thumbnail mt-3" alt="..." style="height:120px;width:200px;">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="fw-bold">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror                        
                    </div>
                    <div class="mb-3">
                        <label for="description" class="fw-bold">Description</label>
                        <textarea class='form-control' name="description" id="description" cols="30" rows="6">{{ $post->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class='fw-bold'>Status</label>
                        <select class='form-select' name="status" id="status">
                            <option value="1" {{ (($post->status)==1)?'selected':'' }}>Active</option>
                            <option value="0" {{ (($post->status)==0)?'selected':'' }}>Inactive</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>        
      </div>        
    </div>
    @section('scripts')
        <script>
            ClassicEditor
                .create( document.querySelector( '#description' ), {
                        removePlugins:  ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
                    } )
                .catch( error => {
                    console.error( error );
                } );
        </script> 
    @endsection
</x-layout>