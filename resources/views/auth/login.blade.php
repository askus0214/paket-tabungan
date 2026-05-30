<x-guest-layout>
    <style>
        /* Mengubah total latar belakang layout guest bawaan agar serasi */
        body {
            background-color: #09090b !important;
            color: #f4f4f5;
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
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
                Celengan Digital 🚀
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
                    <input id="password" class="input-dark" type="password" name="password" required
                        autocomplete="current-password" />
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
</x-guest-layout>
