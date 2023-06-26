<x-layout :$pageTitle>
    <div class='row mb-5 pb-5'>
      <div class="col-md-8 col-lg-6 col-10 mx-auto mt-4">
        <div class='card shadow border-0'>
            <div class="card-body">
                <form action="/post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3 class='text-center mb-4'>Create Post</h3>
                    <div class="mb-3">
                        <label for="image" class="fw-bold">Image</label>
                        <input name="image" class="form-control" type="file" id="image" value="{{ old('image') }}">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="fw-bold">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror                        
                    </div>
                    <div class="mb-3">
                        <label for="description" class="fw-bold">Description</label>
                        <textarea class='form-control' name="description" id="description" cols="30" rows="6"  value="{{ old('description') }}"></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class='fw-bold'>Status</label>
                        <select class='form-select' name="status" id="status">
                            <option selected>Open this select menu</option>
                            <option value="1" {{ (old('status')=='1')?'selected':'' }}>Active</option>
                            <option value="0" {{ (old('status')=='0')?'selected':'' }}>Inactive</option>
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