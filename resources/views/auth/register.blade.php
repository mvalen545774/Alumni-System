<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsters University - Alumni Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
<body class="hero-section bg-gray-50 min-h-screen flex items-center justify-center px-4 py-8">

<div class="hero-content bg-white bg-white bg-white overflow-hidden max-w-2xl rounded-2xl">
    <!-- Logo Area -->
    <div class="bg-[#1a3c5e] text-center mb-4 py-6">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/logo.jpg') }}" alt="Monsters University logo" class="w-20 h-20 rounded-full object-cover bg-[#f5f7fa] border-2 border-[#11274a] shadow-md">
        </div>
        <h2 class="text-2xl font-bold text-[#f2f3f5]">Monsters University</h2>
        <p class="text-blue-200 text-sm">Alumni Register</p>
    </div>

    <!-- Register Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h3 class="text-xl font-semibold text-gray-800 text-center mb-1">Create your Account</h3>
        <p class="text-gray-400 text-sm text-center mb-6">Join the Monster Alumni Community!</p>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Full Name -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student ID -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Student ID</label>
                    <input type="text" name="student_id" value="{{ old('student_id') }}" required 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('student_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Degree Program -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Degree Program</label>
                    <select name="degree_program_id" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="">Select Program</option>
                        @foreach($degreePrograms as $program)
                            <option value="{{ $program->id }}" {{ old('degree_program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->program_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('degree_program_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Year Graduated - DROPDOWN FIXED -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Year Graduated</label>
                    <select name="year_graduated" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= date('Y') - 60; $year--)
                            <option value="{{ $year }}" {{ old('year_graduated') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                    @error('year_graduated')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent pr-10">
                        <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i id="eyeIcon1" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent pr-10">
                        <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i id="eyeIcon2" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-semibold mb-2">Address</label>
                    <textarea name="address" rows="2" required class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="w-full bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white font-semibold py-3 rounded-xl transition mt-6">
                Register
            </button>

            <!-- Login Link - Below the button -->
            <p class="text-center text-gray-600 mt-4">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-[#1a3c5e] hover:text-[#2d5a7b] font-semibold">Login here</a>
            </p>
        </form>
    </div>
</div>

<script>
    function togglePassword(fieldId, iconId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>