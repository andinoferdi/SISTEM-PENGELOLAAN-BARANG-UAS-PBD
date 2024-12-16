<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="bg-body d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="d-flex flex-column align-items-center justify-content-center w-lg-50 p-10">
        <div class="card w-md-500px p-10">
            <h2 class="text-center">Register</h2>
            <form action="{{ route('register') }}" method="POST" class="form">
                @csrf
                <div class="fv-row mb-10">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" autocomplete="off" class="form-control form-control-lg"
                        required>
                </div>

                <div class="fv-row mb-10">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control form-control-lg" required>
                </div>

                <div class="fv-row mb-10">
                    <label for="password_confirmation" class="form-label">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary w-100">Register</button>
                </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-5">{{ $errors->first() }}</div>
            @endif

            <p class="text-center mt-5">Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
