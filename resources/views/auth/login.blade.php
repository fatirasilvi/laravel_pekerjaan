<!DOCTYPE html>
<html lang="id">

<head>
    {{-- Title --}}
    <title>Login</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-4">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h3 class="text-center mb-4">Login</h3>

                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Masukkan email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>

                    </form>

                    <div class="text-center mt-3">
                        <small>
                            Belum punya akun?
                            <a href="{{ route('register') }}">Register</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
