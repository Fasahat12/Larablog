<x-layout :$pageTitle>
    <div class='row mb-5 pb-5'>
      <div class="col-md-8 col-lg-6 col-10 mx-auto mt-4">
        <div class='card shadow border-0'>
            <div class="card-body">
                <form action="/register" method="POST">
                    @csrf
                    <h3 class='text-center mb-4'>Register</h3>
                    <div class="mb-3">
                        <label for="name" class="fw-bold">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror                        
                    </div>
                    <div class="mb-3">
                        <label for="name" class="fw-bold">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror                        
                    </div>
                    <div class="mb-3">
                        <label for="password" class="fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror                        
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="fw-bold">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>                        
                        @enderror                        
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>        
      </div>        
    </div>
</x-layout>