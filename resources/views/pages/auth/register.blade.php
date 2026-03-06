<x-layouts::auth.vibrant :title="__('Register')">
    <div class="relative w-full max-w-[420px] glass-card p-10 pt-24">
        <!-- Profile Icon -->
        <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-32 h-32 bg-[#001b3a] rounded-full flex items-center justify-center border-4 border-white/20 shadow-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="16" y1="11" x2="22" y2="11"/>
            </svg>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Name Area -->
            <div class="flex flex-col">
                <div class="flex h-12 overflow-hidden rounded-lg shadow-inner">
                    <div class="input-group-side">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus
                        class="flex-1 input-field px-4 focus:outline-none text-base">
                </div>
                @error('name')
                    <p class="mt-1 text-xs text-red-200 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Area -->
            <div class="flex flex-col">
                <div class="flex h-12 overflow-hidden rounded-lg shadow-inner">
                    <div class="input-group-side">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required
                        class="flex-1 input-field px-4 focus:outline-none text-base">
                </div>
                @error('email')
                    <p class="mt-1 text-xs text-red-200 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Area -->
            <div class="flex flex-col">
                <div class="flex h-12 overflow-hidden rounded-lg shadow-inner">
                    <div class="input-group-side">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <input type="password" name="password" placeholder="Password" required
                        class="flex-1 input-field px-4 focus:outline-none text-base">
                </div>
                @error('password')
                    <p class="mt-1 text-xs text-red-200 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password Area -->
            <div class="flex flex-col">
                <div class="flex h-12 overflow-hidden rounded-lg shadow-inner">
                    <div class="input-group-side">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                        class="flex-1 input-field px-4 focus:outline-none text-base">
                </div>
            </div>

            <!-- Login Button Area -->
            <div class="relative mt-4">
                <button type="submit" class="w-full navy-btn text-white py-4 rounded-2xl font-bold text-xl tracking-widest uppercase shadow-xl transition-all">
                    REGISTER
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-white/80 text-sm">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-white font-bold hover:underline">LOG IN</a>
        </p>
    </div>
</x-layouts::auth.vibrant>
