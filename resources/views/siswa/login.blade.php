<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Akun | SMK PGRI Gumelar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-white flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="w-full bg-white text-black px-8 py-4 shadow">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo_SMK_PGRI_GUMELAR.jpeg') }}" alt="Logo SMK PGRI Gumelar" class="w-10 h-10 rounded-full">
            <span class="font-semibold text-sm md:text-base">SMK PGRI GUMELAR</span>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-[#0a1b3d] flex-grow flex flex-col items-center justify-center p-10">

        <h1 class="text-2xl font-bold text-white mb-20">Login Akun</h1>

        <form action="{{ route('siswa.login.submit') }}" method="POST"
              class="bg-white text-black px-10 py-10 rounded-2xl shadow-2xl w-full max-w-md"
              onsubmit="return validateForm()">
            @csrf

            <div class="flex items-center gap-10 mb-5">
                <label class="text-sm font-medium text-gray-700 w-40">NIS</label>
                <input type="text" id="nis" name="nis"
                       class="rounded-lg bg-blue-100 px-2 py-1 w-full mt-2">
            </div>

            <div class="flex items-center gap-10 mb-5 relative">
                <label class="text-sm font-medium text-gray-700 w-40">Password</label>
                <input type="password" id="password" name="password"
                    class="rounded-lg bg-blue-100 px-3 py-1 w-full mt-1">

                <span id="togglePassword" onclick="togglePassword()"
                    class="absolute right-3 top-2 cursor-pointer select-none text-gray-600">👁
                </span>
            </div>

            <a href="#" class="text-xs text-blue-800 hover:underline float-right mb-4">
                Lupa Password?
            </a>

            <div class="flex flex-col items-center justify-center mt-8 relative w-full">

                <!-- Notif field -->
                @if ($errors->has('login_error'))
                    <div class="text-red-500 text-sm text-center mb-3">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif

                {{-- Error jika field kosong --}}
                @if ($errors->has('nis') || $errors->has('password'))
                    <div class="text-red-500 text-sm text-center mb-3">
                        Silakan isi NIS dan Password!
                    </div>
                @endif

                {{-- Error dari hasil login --}}
                @if ($errors->has('login_error'))
                    <div class="text-red-500 text-sm text-center mb-3">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif

                <!-- Tombol Masuk -->
                <button type="submit"
                        class="bg-blue-700 text-white px-10 py-2 rounded-lg hover:bg-blue-900">
                    Masuk
                </button>

                <a href="{{ url('/') }}" class="text-red-500 hover:underline text-sm absolute left-0 bottom-0 -mb-6">
                    Kembali
                </a>
            </div>
        </form>
        <script>
    function togglePassword() {
        const passField = document.getElementById('password');
        const icon = document.getElementById('togglePassword');

        if (passField.type === "password") {
            passField.type = "text";
            icon.textContent = "🙈";
        } else {
            passField.type = "password";
            icon.textContent = "👁";
        }
    }
</script>

    </main>

    <!-- Footer -->
    <footer class="bg-white text-black py-2 px-4 text-sm">
        Kontak Kami
    </footer>

</body>
</html>

