<form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{old('name',$user->name)}}" class="form-control" placeholder="Enter Your Name">
                @error('name')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" value="{{old('email',$user->email)}}" class="form-control" placeholder="Enter Your Email">
                @error('email')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" >
                @error('image')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-1 mt-3">
                <p class="fs-5 mb-0">Want to change password?</p>
                <small >If not then leave following fields empty.</small>

            </div>
            <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" name="password" class="form-control" >
                @error('password')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" >
                @error('new_password')
                    <p class="fs-6 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="text-end">
                <button class="btn btn-dark">Save Changes</button>
            </div>
        </div>
        <div class="col-lg-6 d-flex justify-content-center align-items-center h-full">
           <div class="">
            @if ($user->image)
            <img src="{{URL::asset('storage/'.$user->image)}}" class="img-fluid" alt="">
                
            @else
                <p class="fs-6 text-danger text-center mt-5">Please Upload Image</p>
            @endif
           </div>
        </div>
    </div>
  
   
    
</form>