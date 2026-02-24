<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - LPK Maheswara</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #fff5f5; /* Merah sangat muda, senada dengan landing page */
            font-family: 'Poppins', sans-serif;
        }
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card-login {
            border: none;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(198, 40, 40, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        .card-header-red {
            background: linear-gradient(135deg, #c62828 0%, #8e0000 100%);
            color: white;
            text-align: center;
            padding: 40px 20px 30px;
            border-bottom: none;
        }
        .btn-primary-red {
            background-color: #c62828;
            color: white;
            font-weight: 600;
            border-radius: 50px;
            padding: 12px;
            transition: 0.3s;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary-red:hover {
            background-color: #8e0000;
            color: white;
            box-shadow: 0 5px 15px rgba(198, 40, 40, 0.3);
        }
        /* Custom form focus color to match red theme */
        .form-control:focus {
            border-color: #c62828;
            box-shadow: 0 0 0 0.25rem rgba(198, 40, 40, 0.25);
        }
        .form-check-input:checked {
            background-color: #c62828;
            border-color: #c62828;
        }
        .text-red { color: #c62828; text-decoration: none; font-weight: 500;}
        .text-red:hover { color: #8e0000; text-decoration: underline; }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="card card-login bg-white">
        <div class="card-header-red">
            <i class="fa-solid fa-graduation-cap fs-1 mb-2"></i>
            <h3 class="fw-bold mb-0 tracking-tight">LPK MAHESWARA</h3>
            <p class="text-white-50 small mt-1 mb-0">Sistem Manajemen Admin</p>
        </div>

        <div class="card-body p-4 p-md-5">
            @if (session('status'))
                <div class="alert alert-success p-2 small text-center mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label fw-bold text-dark">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-envelope"></i></span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control border-start-0 bg-light @error('email') is-invalid @enderror" placeholder="admin@lpkmaheswara.com">
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1 fw-medium">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold text-dark">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-lock"></i></span>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control border-start-0 bg-light @error('password') is-invalid @enderror" placeholder="••••••••">
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1 fw-medium">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                        <label class="form-check-label text-muted small" for="remember_me">
                            {{ __('Ingat Saya') }}
                        </label>
                    </div>
                    {{-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-red small">Lupa password?</a>
                    @endif --}}
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary-red py-2">
                        {{ __('Masuk Panel') }}
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ url('/') }}" class="text-muted small text-decoration-none hover-red">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Landing Page
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
