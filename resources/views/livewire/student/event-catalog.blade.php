<div class="py-6">
    <div class="mb-10">
        <h2 class="text-4xl font-black text-white mb-2 italic tracking-tight">Available <span class="text-[#002d5b]">Workshops</span></h2>
        <p class="text-white/70 text-lg">Boost your skills with our Senior-led sessions. You can join up to <span class="text-white font-bold underline">3 workshops</span>.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($events as $event)
            @php
                $isRegistered = in_array($event->id, $userRegistrations);
                $isFull = $event->registrations_count >= $event->total_seats;
                $remaining = $event->total_seats - $event->registrations_count;
                $limitReached = count($userRegistrations) >= 3;
            @endphp
            <div class="relative group">
                <!-- Glassmorphism Card -->
                <div class="h-full bg-white/10 backdrop-blur-2xl rounded-[2.5rem] p-8 border border-white/20 shadow-2xl transition-all duration-500 {{ $isRegistered ? 'ring-2 ring-white/30 ring-offset-4 ring-offset-transparent' : 'hover:scale-[1.02] hover:bg-white/15' }} flex flex-col justify-between overflow-hidden">
                    
                    @if($isRegistered)
                        <div class="absolute top-0 right-0 bg-[#002d5b] text-white text-[10px] font-black uppercase tracking-[0.2em] px-6 py-3 rounded-bl-3xl shadow-lg border-l border-b border-white/10">Registered</div>
                    @endif

                    <div>
                        <div class="flex items-center gap-5 mb-8">
                            <div class="w-16 h-16 bg-[#002d5b] rounded-2xl flex items-center justify-center text-white shadow-[0_8px_30px_rgb(0,0,0,0.3)] border border-white/10 group-hover:rotate-6 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-black text-white text-xl leading-tight group-hover:text-blue-200 transition-colors uppercase tracking-tighter">{{ $event->title }}</h3>
                                <p class="text-[10px] text-white/50 uppercase font-black tracking-[0.3em] mt-2">{{ $event->speaker }}</p>
                            </div>
                        </div>

                        <div class="space-y-4 mb-10">
                            <div class="flex items-center gap-3 text-white/80 font-medium">
                                <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                </div>
                                <span class="text-sm">{{ $event->location }}</span>
                            </div>
                            
                            <div class="space-y-2">
                                <div class="flex justify-between items-end mb-1">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-white/40">Status</span>
                                    <span class="text-xs font-black {{ $isFull ? 'text-red-400' : 'text-white' }}">
                                        {{ $event->registrations_count }} / {{ $event->total_seats }} Registered
                                    </span>
                                </div>
                                <div class="w-full bg-black/20 h-3 rounded-full overflow-hidden p-[2px] border border-white/10">
                                    <div class="h-full rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(255,255,255,0.3)] {{ $isFull ? 'bg-red-500' : ($remaining <= 2 ? 'bg-orange-400' : 'bg-blue-400') }}" 
                                         style="width: {{ ($event->registrations_count / $event->total_seats) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto">
                        @if($isRegistered)
                            <button wire:click="cancel({{ $event->id }})" wire:loading.attr="disabled" wire:confirm="Are you sure you want to cancel this registration?" class="w-full py-5 border border-white/20 text-white rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] hover:bg-white/10 transition-all backdrop-blur-md disabled:opacity-50">
                                <span wire:loading.remove wire:target="cancel({{ $event->id }})">Cancel Registration</span>
                                <span wire:loading wire:target="cancel({{ $event->id }})">Processing...</span>
                            </button>
                        @elseif($isFull)
                            <button disabled class="w-full py-5 bg-white/5 border border-white/10 text-white/30 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] cursor-not-allowed">
                                Closed (Fully Booked)
                            </button>
                        @elseif($limitReached)
                            <button disabled class="w-full py-5 bg-white/5 border border-white/10 text-white/30 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] cursor-not-allowed" title="You have reached the limit of 3 workshops">
                                Limit Reached (3/3)
                            </button>
                        @else
                            <button wire:click="register({{ $event->id }})" wire:loading.attr="disabled" class="w-full py-5 bg-[#002d5b] text-white rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] hover:bg-[#003d7b] shadow-[0_10px_40px_rgba(0,0,0,0.3)] border border-white/10 transform hover:-translate-y-1 transition-all active:scale-95 group-hover:shadow-[#002d5b]/40 disabled:opacity-50">
                                <span wire:loading.remove wire:target="register({{ $event->id }})">Reserve My Seat</span>
                                <span wire:loading wire:target="register({{ $event->id }})">Processing...</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($events) === 0)
        <div class="bg-white/5 backdrop-blur-xl rounded-[3rem] p-24 text-center border border-dashed border-white/20 shadow-2xl">
            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1" stroke-opacity="0.3" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
            </div>
            <p class="text-white/40 font-black uppercase tracking-[0.3em] text-sm">No workshops scheduled at the moment.</p>
        </div>
    @endif
</div>