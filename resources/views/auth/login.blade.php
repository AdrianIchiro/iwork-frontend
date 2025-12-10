@extends('layouts.auth')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background:#eaeaea;">

        <div class="register-card">

            <div class="text-center mb-4">
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <span class="title-dot"></span>
                    <h2 class="m-0">Login</h2>
                </div>
                <p class="text-muted mt-2">Masuk untuk melanjutkan ke halaman utama</p>
            </div>

            @if ($errors->has('api_error'))
                <div class="alert alert-danger">
                    {{ $errors->first('api_error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.action') }}" method="POST">
                @csrf

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Masukkan email" required>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>

                    <div class="password-wrapper">
                        <input type="password" name="password" class="form-control password-input"
                            placeholder="Masukkan password" required>

                        <span class="toggle-password" onclick="togglePassword()">
                            <i id="password-icon" class="fa-regular fa-eye"></i>
                        </span>
                    </div>
                </div>


                {{-- SUBMIT --}}
                <button class="btn btn-custom w-100 mt-3" type="submit">Login</button>

                <a href="/register" class="btn-register mt-3 d-block text-center">
                    Register
                </a>
            </form>

        </div>

    </div>
@endsection

@push('styles')
    <style>
        body {
            background: #eaeaea;
        }

        .register-card {
            max-width: 650px;
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
            background: #fff;
            padding: 50px 45px;
        }

        .form-control {
            border-radius: 25px;
            padding: 14px 20px;
            font-size: 16px;
        }

        .btn-custom {
            background: #00b4ff;
            border-radius: 25px;
            padding: 14px;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .btn-custom:hover {
            background: #0194d3;
        }

        .title-dot {
            height: 14px;
            width: 14px;
            background: #00b4ff;
            border-radius: 50%;
        }

        .btn-register {
            width: 100%;
            padding: 14px 0;
            border-radius: 999px;
            border: 2px solid #00C6FF;
            color: #00C6FF;
            background: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(0, 198, 255, 0.3);
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-register:hover {
            background: #00C6FF;
            color: white;
        }

        .password-wrapper {
            position: relative;
        }

        .password-input {
            padding-right: 45px !important;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #888;
        }

        .toggle-password:hover {
            color: #555;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function togglePassword() {
            const input = document.querySelector('.password-input');
            const icon = document.getElementById('password-icon');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
@endpush
