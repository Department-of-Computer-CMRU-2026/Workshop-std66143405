<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <style>
            .auth-bg {
                background: linear-gradient(135deg, #2c3e50, #4ca1af);
                background-attachment: fixed;
                position: relative;
                overflow: hidden;
            }
            .auth-bg::before {
                content: "";
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
                animation: rotate 20s linear infinite;
            }
            @keyframes rotate {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 40px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }
            .navy-btn {
                background: #002d5b;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .navy-btn:hover {
                background: #003d7b;
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body class="min-h-screen antialiased auth-bg flex items-center justify-center p-6">
        <div class="relative w-full max-w-4xl glass-card overflow-hidden flex flex-col md:flex-row shadow-2xl">
            <!-- Left Info Section -->
            <div class="flex-1 p-12 flex flex-col justify-center gap-6">
                <div>
                    <h2 class="text-white/70 text-sm font-bold tracking-[0.3em] uppercase mb-2">University Event</h2>
                    <h1 class="text-white text-5xl font-black leading-tight italic tracking-tighter">
                        Senior-to-Junior<br>
                        <span class="text-[#002d5b]">WORKSHOP</span>
                    </h1>
                </div>
                
                <p class="text-white/90 text-lg leading-relaxed max-w-md">
                    Dive deep into specialized topics led by experienced seniors. 
                    Manage your subscriptions and reserve your seats for the upcoming sessions.
                </p>

                <div class="flex gap-4 mt-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="navy-btn text-white px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-sm shadow-lg">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="navy-btn text-white px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-sm shadow-lg">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="bg-white/20 hover:bg-white/30 text-white px-8 py-4 rounded-xl font-bold uppercase tracking-widest text-sm backdrop-blur shadow-lg transition-all">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Right Visual Section -->
            <div class="w-full md:w-[40%] bg-[#001b3a]/20 backdrop-blur-md flex items-center justify-center p-12 border-l border-white/10">
                <div class="relative">
                    <div class="w-48 h-48 bg-[#002d5b] rounded-full flex items-center justify-center shadow-[0_0_50px_rgba(0,0,0,0.5)] border-4 border-white/10">
                         <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        @if (Route::has('login'))
            <div class="fixed top-8 right-8 flex gap-6 z-20">
                @auth
                    <!-- Authenticated User Dropdown/Menu could go here -->
                @endauth
            </div>
        @endif

        @fluxScripts
    </body>
</html>
