<x-guest-layout>
    <style>
        body {
            background-color: #09090b !important;
            color: #f4f4f5;
            font-family: 'Inter', sans-serif;
        }

        /* Navbar Style */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(9, 9, 11, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #27272a;
            z-index: 1000;
            padding: 16px 24px;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #f4f4f5;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }

        .nav-links a {
            color: #a1a1aa;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #f4f4f5;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 100px 24px 24px 24px;
            /* Diberi top padding agar tidak tertutup Navbar */
        }

        .login-box {
            background-color: #18181b;
            border: 1px solid #27272a;
            padding: 40px 32px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
        }

        .input-dark {
            background-color: #202023 !important;
            border: 1px solid #27272a !important;
            color: #fff !important;
            border-radius: 12px !important;
            padding: 12px 16px !important;
            width: 100%;
            box-sizing: border-box;
            transition: all 0.2s;
            margin-top: 4px;
        }

        .input-dark:focus {
            border-color: #fb923c !important;
            outline: none;
            box-shadow: 0 0 0 2px rgba(251, 146, 60, 0.2) !important;
        }

        .btn-primary-custom {
            background-color: #fb923c !important;
            color: #000 !important;
            font-weight: 700 !important;
            text-transform: none !important;
            letter-spacing: normal !important;
            padding: 12px 24px !important;
            border-radius: 12px !important;
            border: none !important;
            cursor: pointer;
            transition: all 0.2s !important;
        }

        .btn-primary-custom:hover {
            background-color: #f97316 !important;
            transform: translateY(-1px);
        }
    </style>

    <!-- Navigation Bar -->
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">
                🌙 Tabungan Lebaranku
            </a>
            <ul class="nav-links">
                <li><a href="/#beranda">Beranda</a></li>
                <li><a href="/#tentang">Mengapa Kami</a></li>
                <li><a href="/#kontak">Hubungi Kami</a></li>
            </ul>
        </div>
    </nav>

    <div class="login-container">
        <div style="text-align: center; margin-bottom: 24px;">
            <div
                style="display: inline-flex; align-items: center; justify-content: center; background: rgba(251, 146, 60, 0.1); padding: 16px; border-radius: 20px; margin-bottom: 16px; border: 1px solid rgba(251, 146, 60, 0.2);">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="#fb923c" style="width: 48px; height: 48px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 10.25h6M9 13.75h6M12 8.25v7.5" />
                </svg>
            </div>
            <h2
                style="font-family: 'Plus Jakarta Sans', sans-serif; font-size: 28px; font-weight: 800; color: #fff; margin: 0 0 4px 0; letter-spacing: -0.5px;">
                Tabungan Lebaranku🚀
            </h2>
            <p style="color: #71717a; margin: 0; font-size: 14px;">Silakan masuk untuk memantau tabungan Anda</p>
        </div>

        <div class="login-box">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label for="email"
                        style="display: block; font-size: 13px; font-weight: 600; color: #a1a1aa;">Email</label>
                    <input id="email" class="input-dark" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: #ef4444;" />
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password"
                        style="display: block; font-size: 13px; font-weight: 600; color: #a1a1aa;">Password</label>
                    <div style="position: relative; display: flex; align-items: center;">
                        <input id="password" class="input-dark" type="password" name="password" required
                            autocomplete="current-password" style="padding-right: 45px !important;" />
                        <button type="button" onclick="togglePasswordVisibility()"
                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-30%); background: none; border: none; cursor: pointer; color: #a1a1aa; display: flex; align-items: center; justify-content: center; padding: 0;">
                            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.573 16.493 16.638 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                style="width: 20px; height: 20px; display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: #ef4444;" />
                </div>

                <div class="block" style="margin-bottom: 24px;">
                    <label for="remember_me" class="inline-flex items-center" style="cursor: pointer;">
                        <input id="remember_me" type="checkbox"
                            style="border-radius: 4px; background-color: #202023; border-color: #27272a; color: #fb923c;"
                            name="remember">
                        <span class="ms-2 text-sm" style="color: #71717a;">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between;">
                    @if (Route::has('password.request'))
                        <a style="font-size: 13px; color: #71717a; text-decoration: none; transition: color 0.2s;"
                            href="{{ route('password.request') }}" onmouseover="this.style.color='#fff'"
                            onmouseout="this.style.color='#71717a'">
                            Lupa password?
                        </a>
                    @endif

                    <button type="submit" class="btn-primary-custom">
                        Masuk Aplikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>
</x-guest-layout>
