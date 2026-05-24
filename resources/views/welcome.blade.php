<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monsters University - Alumni System</title>
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
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 py-4 px-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.jpg') }}" alt="Monsters University logo featuring a blue and gold crest for the alumni system landing page" class="w-10 h-10 object-contain">
                <div class="flex items-center gap-2">
                    <span class="text-xl font-bold text-[#1a3c5e]">Monsters <span class="text-[#f5a623]">University</span></span>          
                </div>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <div class="hero-section min-h-[calc(100vh-73px)] flex items-center justify-center px-8 py-12">
        <div class="hero-content max-w-6xl mx-auto w-full">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                
                <!-- Left Section -->
                <div class="text-white">
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">
                        Welcome To,<br>
                        <span class="text-[#f5a623]">Monsters University</span>
                    </h1>
                    <p class="text-xl text-blue-100 mb-8">Alumni System</p>
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-2 text-[#f5a623]">About University</h3>
                        <p class="text-blue-100 leading-relaxed">
                            Monsters University has been the premier institution for scare education since 1313. We nurture the finest monsters in the art of scaring, academics, and camaraderie — shaping graduates who go on to power the world, one scream at a time.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="bg-[#f5a623] text-[#1a3c5e] px-6 py-3 rounded-full font-bold hover:bg-[#f4b84a] transition shadow-lg">
                            Join Alumni
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-white text-white px-6 py-3 rounded-full font-bold hover:bg-white hover:text-[#1a3c5e] transition">
                            Login
                        </a>
                    </div>
                </div>

                <!-- Monster Mascot Area -->
                <div class="hidden md:flex justify-center">
                    <div class="relative">
                        <div class="w-80 h-80 bg-[#0e2742] rounded-full flex items-center justify-center shadow-2xl">
                            <img src="{{ asset('images/mikeandsulli.png') }}" alt="Mike Wazowski" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-[#4a90b8] rounded-full flex items-center justify-center shadow-lg">
                            <img src="{{ asset('images/mike.png') }}" alt="Mike Wazowski" class="w-full h-full object-cover rounded-full mb-1">
                        </div>
                        <div class="absolute -top-3 -right-5 w-20 h-20 bg-[#2d5a7b] rounded-full flex items-center justify-center shadow-lg ">
                            <img src="{{ asset('images/sulli.png') }}" alt="Sully" class="w-full h-full object-cover rounded-full mb-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
     <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#1a3c5e] mb-2">Alumni Features</h2>
                <p class="text-gray-500">Everything you need to stay connected</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-6 text-center monster-card shadow-md">
                    <div class="w-16 h-16 bg-[#e8f4f8] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-[#1a3c5e]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a3c5e] mb-2">Alumni Directory</h3>
                    <p class="text-gray-500">Find and connect with fellow graduates</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center monster-card shadow-md">
                    <div class="w-16 h-16 bg-[#e8f4f8] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-briefcase text-2xl text-[#1a3c5e]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a3c5e] mb-2">Job Boards</h3>
                    <p class="text-gray-500">Post and find job opportunities</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 text-center monster-card shadow-md">
                    <div class="w-16 h-16 bg-[#e8f4f8] rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-edit text-2xl text-[#1a3c5e]"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a3c5e] mb-2">My Profile</h3>
                    <p class="text-gray-500">Update your employment info</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#1a3c5e] text-white py-8">
        <div class="text-center">
            <p>© 2026 Monsters University Alumni Management System</p>
            <p class="text-blue-200 text-sm mt-2">"Once a Monster, Always a Monster"</p>
        </div>
    </footer>
</body>
</html>