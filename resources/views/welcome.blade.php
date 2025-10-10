<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parktech</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white font-poppins">

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full bg-white shadow-sm flex justify-between items-center px-8 py-4 z-50">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/parktech-logo.png') }}" alt="Parktech Logo">
        </div>
        @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="bg-[#3C345C] text-white text-sm px-5 py-1.5 rounded-md hover:bg-[#2C2545] transition"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="bg-[#3C345C] text-white text-sm md:text-xl md:px-10 px-5 py-1.5 rounded-md hover:bg-[#2C2545] transition"
                        >
                            Log in
                        </a>
                    @endauth
                </nav>
            @endif
    </header>

    <!-- Main Section -->
    <main class="flex flex-col md:flex-row justify-center md:justify-between items-center h-auto md:h-screen px-6 md:px-24 py-10 md:py-0 space-y-10 md:space-y-0 pt-40">

        <!-- Text Section -->
        <div class="w-full md:w-1/2 space-y-4 text-center md:text-left">
            <h1 class="text-4xl sm:text-5xl md:text-[70px] font-semibold leading-tight">
                Smart Parking Dashboard
            </h1>

            <p class="text-base sm:text-lg md:text-[25px] font-light leading-relaxed text-gray-600 px-2 md:px-0">
                Monitor, manage, and visualize parking slot availability in real time — powered by IoT technology.
            </p>

            <div class="flex justify-center md:justify-start">
                <button class="bg-[#3C345C] text-white text-sm sm:text-base md:text-xl px-6 py-3 rounded-md hover:bg-[#2C2545] transition">
                    Get Started
                </button>
            </div>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('images/car.png') }}" alt="Car Illustration" class="w-64 sm:w-80 md:w-[800px] object-contain">
        </div>

    </main>
</body>
</html>
