<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NAKAE Works Admin - Login</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        body {
            /* Animated Gradient Background */
            background: linear-gradient(-45deg, #4e73df, #2e59d9, #667eea, #764ba2);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .full-page-wrapper {
            min-height: 100vh;
        }

        /* Glassmorphism / Premium Card Style */
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem 4rem;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            width: 100%;
            max-width: 470px;
            transform: translateY(0);
            transition: all 0.4s ease;
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .auth-logo {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            letter-spacing: -0.5px;
        }

        .auth-logo span {
            background: linear-gradient(135deg, #4e73df, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        /* Input Styling */
        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: #6c757d;
            border-radius: 10px 0 0 10px;
        }

        .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
            padding: 0.8rem 1rem;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        /* Add a focus ring around the whole input group */
        .input-group:focus-within {
            box-shadow: 0 0 0 4px rgba(78, 115, 223, 0.15);
            border-radius: 10px;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: #4e73df;
            color: #4e73df;
        }

        /* Button Styling */
        .btn-custom {
            background: linear-gradient(135deg, #4e73df 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.85rem;
            font-weight: 600;
            border-radius: 10px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #3a5bbf 0%, #5d3a82 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 115, 223, 0.6);
        }

        .invalid-feedback {
            font-weight: 500;
            margin-top: 0.5rem;
        }
    </style>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="body-wrapper">
        <div class="main-wrapper">
            <div class="page-wrapper full-page-wrapper d-flex align-items-center justify-content-center">
                <main class="auth-page px-3">

                    <div class="auth-card">
                        <div class="auth-logo text-center mb-2">
                            <img src="{{ asset('assets/images/icon.png') }}" alt="NAKAE Works Logo" width="90" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        </div>
                        <div class="auth-logo text-center">
                            NAKAE <span>Works</span>
                        </div>
                        <p class="auth-subtitle">Welcome back! Please login to your account.</p>

                        <!-- Session Error Alert -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ route('adm.login') }}" method="POST">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="admin@nakaeworks.com"
                                           required autofocus>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-info-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="••••••••"
                                           required>
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1 fw-semibold">
                                        <i class="bi bi-info-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-custom w-100 mt-2">
                                Secure Login <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
                            </button>
                        </form>

                    </div>

                </main>
            </div>
        </div>
    </div>

</body>

</html>
