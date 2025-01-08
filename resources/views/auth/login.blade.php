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
                <h4>Login</h4>
                <p>Are You Student or Admin?</p>
            </div>
            <div class="card-body">
                <x-message></x-message>
                <form action="{{ route('login.check') }}" method="post">
                    @csrf
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
                        <input type="submit" value="Login" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="card-footer ">
                <p>Looking for registration ? click <a href="{{ route('register') }}">here</a></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
