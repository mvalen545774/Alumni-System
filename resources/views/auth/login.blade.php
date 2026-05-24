<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsters University - Alumni Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-section {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(26, 60, 94, 0.85) 0%, rgba(45, 90, 123, 0.8) 100%);
            
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
    </style>
</head>
<body class="hero-section min-h-screen flex items-center justify-center px-4">

    <div class="hero-content bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
        <!-- Header -->
        <div class="bg-[#1a3c5e] px-6 py-4 text-center">
            <div class="flex justify-center mb-4 ">
                <img src="{{ asset('images/logo.jpg') }}" alt="Monsters University logo" class="w-20 h-20 rounded-full object-cover bg-[#f5f7fa] border-2 border-[#11274a] shadow-md">
            </div>
            <h2 class="text-2xl font-bold text-white">Monsters University</h2>
            <p class="text-blue-200 text-sm">Alumni Login</p>
        </div>

        <!-- Body -->
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-800 text-center mb-2">Login to your account</h3>
            <p class="text-gray-500 text-sm text-center mb-6">Welcome back, Monster!</p>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    @foreach($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1a3c5e] focus:border-transparent"
                        placeholder="your@email.com">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent pr-10"
                        placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white font-semibold py-3 rounded-lg transition">
                    Login
                </button>

                <p class="text-center text-gray-600 mt-6">
                    No account? <a href="{{ route('register') }}" class="text-[#1a3c5e] hover:text-[#2d5a7b] font-semibold">Register here</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                passwordInput.type = 'password';
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';

            }

        }
        // Unverified Account Modal Popup
        @if(session('unverified'))
        Swal.fire({
            title: 'Account Not Verified!',
            text: 'Your account is pending approval from the administrator. Please wait for admin confirmation.',
            icon: 'warning',
            confirmButtonText: 'I Understand',
            confirmButtonColor: '#1a3c5e',
        });
        @endif
    </script>
</body>
</html>