<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">

    <title>Document</title>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4>Registeration</h4>
                <p>Are You Student?</p>
            </div>
            <div class="card-body">
                <x-message></x-message>
                <form action="{{ route('registration') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" required value="{{ old('name') }}" name="name" class="form-control">
                        @error('name')
                            <p class="fs-6 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" required value="{{ old('email') }}" name="email" class="form-control">
                        @error('email')
                            <p class="fs-6 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" required value="{{ old('password') }}" name="password"
                            class="form-control">
                        @error('password')
                            <p class="fs-6 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" required value="{{ old('confirm_password') }}" name="confirm_password"
                            class="form-control">
                        @error('confirm_password')
                            <p class="fs-6 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Register" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="card-footer ">
                <p>Already have a account ? click <a href="{{ route('login') }}">here</a></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
