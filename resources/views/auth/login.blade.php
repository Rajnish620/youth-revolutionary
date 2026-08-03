<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Youth Revolutionary</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Fallback Tailwind CSS to guarantee styling renders correctly -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Snow Animation Keyframes */
        .snowflake {
            position: absolute;
            top: -10vh;
            background: white;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.8;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-10vh) translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateY(110vh) translateX(20px);
                opacity: 0.3;
            }
        }
        
        .glass-panel {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }
        
        .glass-input {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: white;
        }
        
        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 1);
            outline: none;
            box-shadow: 0 0 5px rgba(255,255,255,0.3);
        }
    </style>
</head>
<body class="h-screen w-full overflow-hidden flex items-center justify-center bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542224566-6e85f2e6772f?auto=format&fit=crop&q=80&w=1920'); background-color: #5b21b6; background-blend-mode: multiply;">
    
    <!-- Snowflakes Container -->
    <div id="snow-container" class="absolute inset-0 pointer-events-none z-0"></div>

    <!-- Glassmorphism Login Card -->
    <div class="relative z-10 w-[90%] max-w-[400px] p-8 sm:p-10 rounded-3xl glass-panel flex flex-col items-center">
        
        <h2 class="text-3xl font-bold text-center text-white mb-8 tracking-wide">Login</h2>
        
        <form method="POST" action="{{ route('login') }}" class="w-full space-y-6">
            @csrf
            
            <!-- Email/Username -->
            <div class="w-full">
                <div class="relative flex items-center">
                    <input type="email" name="email" id="email" required placeholder="Username" value="{{ old('email') }}"
                        class="w-full glass-input rounded-full px-5 py-3 pr-12 transition-all text-sm sm:text-base">
                    <i class="fa-solid fa-user absolute right-5 text-white/80"></i>
                </div>
                @error('email')
                    <p class="text-red-300 text-xs mt-1 ml-4 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="w-full">
                <div class="relative flex items-center">
                    <input type="password" name="password" id="password" required placeholder="Password"
                        class="w-full glass-input rounded-full px-5 py-3 pr-12 transition-all text-sm sm:text-base">
                    <i class="fa-solid fa-lock absolute right-5 text-white/80"></i>
                </div>
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-white/90 text-xs sm:text-sm px-2 mt-2 w-full">
                <label class="flex items-center gap-2 cursor-pointer hover:text-white transition-colors">
                    <input type="checkbox" name="remember" class="rounded border-white/40 bg-transparent text-purple-600 focus:ring-0 w-3 h-3 sm:w-4 sm:h-4">
                    Remember me
                </label>
                <a href="#" class="hover:text-white transition-colors">Forgot password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                class="w-full bg-white text-gray-900 font-bold rounded-full py-3 mt-6 hover:bg-gray-100 transition-all transform hover:-translate-y-0.5 shadow-md border-0">
                Login
            </button>

            <div class="text-center text-white/90 text-xs sm:text-sm mt-6 w-full">
                Don't have an account? <a href="{{ url('/register') }}" class="text-white font-bold hover:underline">Register</a>
            </div>
        </form>
    </div>

    <!-- Dynamic Snow Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById('snow-container');
            const flakeCount = 100; // Number of snowflakes
            
            for(let i = 0; i < flakeCount; i++) {
                let flake = document.createElement('div');
                flake.className = 'snowflake';
                
                // Randomize properties for natural look
                let size = Math.random() * 4 + 2; // 2px to 6px
                let startLeft = Math.random() * 100; // 0 to 100vw
                let duration = Math.random() * 10 + 5; // 5s to 15s fall time
                let delay = Math.random() * 10; // 0 to 10s delay
                let opacity = Math.random() * 0.5 + 0.3; // 0.3 to 0.8 opacity
                
                flake.style.width = size + 'px';
                flake.style.height = size + 'px';
                flake.style.left = startLeft + 'vw';
                flake.style.animationDuration = duration + 's';
                flake.style.animationDelay = '-' + delay + 's';
                flake.style.opacity = opacity;
                
                container.appendChild(flake);
            }
        });
    </script>
</body>
</html>
