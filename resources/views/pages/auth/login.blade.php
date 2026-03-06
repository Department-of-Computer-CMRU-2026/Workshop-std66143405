<x-layouts::auth.vibrant :title="__('Log in')">
    <div class="relative w-full max-w-[420px] glass-card p-10 pt-24">
        <!-- Profile Icon -->
        <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-32 h-32 bg-[#001b3a] rounded-full flex items-center justify-center border-4 border-white/20 shadow-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-8">
            @csrf

            <!-- Email Area -->
            <div class="flex flex-col">
                <div class="flex h-14 overflow-hidden rounded-lg shadow-inner">
                    <div class="input-group-side">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email ID" required autofocus
                        class="flex-1 input-field px-4 focus:outline-none text-lg">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-200 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Area -->
            <div class="flex flex-col">
                <div class="flex h-14 overflow-hidden rounded-lg shadow-inner">
                    <div class="input-group-side">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <input type="password" name="password" placeholder="Password" required
                        class="flex-1 input-field px-4 focus:outline-none text-lg">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-200 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Options -->
            <div class="flex items-center justify-between text-white/90 text-sm italic font-medium">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-none bg-white text-navy-btn">
                    <span>Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="hover:underline">Forgot Password?</a>
            </div>

            <!-- Login Button Area -->
            <div class="relative mt-4">
                <button type="submit" class="w-full navy-btn text-white py-4 rounded-2xl font-bold text-xl tracking-widest uppercase shadow-xl transition-all">
                    LOGIN
                </button>
                <!-- Shadow/Effect for button footer look -->
                <div class="absolute -bottom-2 left-4 right-4 h-10 bg-black/10 -z-10 rounded-full blur-xl"></div>
            </div>
        </form>

        @if (Route::has('register'))
            <p class="mt-10 text-center text-white/80 text-sm">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-white font-bold hover:underline">SIGN UP</a>
            </p>
        @endif
    </div>
</x-layouts::auth.vibrant>
