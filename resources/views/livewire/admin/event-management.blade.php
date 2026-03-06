<div class="py-6 space-y-10">
    <!-- Header & Action -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-4xl font-black text-white italic tracking-tight uppercase">Admin <span class="text-[#002d5b]">Dashboard</span></h2>
            <p class="text-white/60 text-sm mt-1 font-bold tracking-widest uppercase">Senior-to-Junior Workshop Management</p>
        </div>
        <button wire:click="create" class="bg-[#002d5b] text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-[#003d7b] shadow-[0_10px_40px_rgba(0,0,0,0.3)] border border-white/10 transition-all hover:-translate-y-1 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7v14"/></svg>
            Add New Workshop
        </button>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="glass-card rounded-[2.5rem] p-8 border border-white/20 shadow-2xl">
            <p class="text-white/40 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Total Workshops</p>
            <h3 class="text-5xl font-black text-white tabular-nums">{{ count($events) }}</h3>
        </div>
        <div class="glass-card rounded-[2.5rem] p-8 border border-white/20 shadow-2xl">
            <p class="text-white/40 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Total Registrations</p>
            <h3 class="text-5xl font-black text-white tabular-nums">{{ $totalRegistrations }}</h3>
        </div>
        <div class="glass-card rounded-[2.5rem] p-8 border border-white/20 shadow-2xl bg-[#002d5b]/20">
            @php 
                $totalSeats = $events->sum('total_seats');
                $remainingSeats = $totalSeats - $totalRegistrations;
            @endphp
            <p class="text-white/40 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Available Seats</p>
            <h3 class="text-5xl font-black text-white tabular-nums">{{ $remainingSeats }}</h3>
        </div>
    </div>

    <!-- Workshops Table -->
    <div class="glass-card rounded-[3rem] overflow-hidden border border-white/20 shadow-2xl">
        <div class="p-8 border-b border-white/10 bg-white/5">
            <h3 class="text-white font-black uppercase tracking-[0.2em] text-sm">Workshop Catalog</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-white/40 text-[10px] font-black uppercase tracking-[0.3em] border-b border-white/5">
                        <th class="px-8 py-6">Workshop</th>
                        <th class="px-8 py-6">Speaker</th>
                        <th class="px-8 py-6">Location</th>
                        <th class="px-8 py-6">Registration</th>
                        <th class="px-8 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($events as $event)
                        <tr class="group hover:bg-white/5 transition-colors">
                            <td class="px-8 py-6">
                                <span class="text-white font-black text-lg group-hover:text-blue-200 transition-colors uppercase tracking-tight">{{ $event->title }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-white/80 font-medium text-sm">{{ $event->speaker }}</span>
                            </td>
                            <td class="px-8 py-6 text-white/60 text-xs font-bold uppercase tracking-widest">
                                {{ $event->location }}
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 w-24 bg-black/30 h-1.5 rounded-full overflow-hidden border border-white/5">
                                        <div class="bg-white h-full transition-all duration-1000" style="width: {{ ($event->registrations_count / $event->total_seats) * 100 }}%"></div>
                                    </div>
                                    <span class="text-[10px] font-black text-white whitespace-nowrap uppercase tracking-widest">
                                        {{ $event->registrations_count }} / {{ $event->total_seats }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right space-x-2">
                                <button wire:click="showRegistrants({{ $event->id }})" class="text-blue-400/50 hover:text-blue-400 transition-colors mr-4" title="View Registrants">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                </button>
                                <button wire:click="edit({{ $event->id }})" class="text-white/50 hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                                </button>
                                <button wire:click="delete({{ $event->id }})" wire:confirm="Are you sure? This will delete all registrations for this event." class="text-red-400/50 hover:text-red-400 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center text-white/30 font-black uppercase tracking-[0.3em] text-xs">No Workshops found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Registrants Modal -->
    @if($showRegistrantsModal && $viewingEvent)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-6 backdrop-blur-md bg-black/40">
            <div class="glass-card w-full max-w-2xl rounded-[3rem] p-12 border border-white/30 shadow-[0_0_100px_rgba(0,0,0,0.5)] transform animate-in fade-in zoom-in duration-300">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-white italic tracking-tighter uppercase line-clamp-1">{{ $viewingEvent->title }}</h3>
                        <p class="text-[10px] text-white/40 font-black uppercase tracking-[0.3em] mt-1">Registrant List ({{ count($viewingEvent->registrations) }} students)</p>
                    </div>
                    <button wire:click="$set('showRegistrantsModal', false)" class="text-white/30 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="grid grid-cols-1 gap-4">
                        @forelse($viewingEvent->registrations as $reg)
                            <div class="flex items-center gap-4 bg-white/5 border border-white/10 rounded-2xl p-4">
                                <div class="w-12 h-12 bg-[#002d5b] rounded-xl flex items-center justify-center text-white font-black text-xs border border-white/10">
                                    {{ $reg->user->initials() }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-white font-bold text-sm">{{ $reg->user->name }}</p>
                                    <p class="text-white/40 text-[10px] font-medium tracking-wider">{{ $reg->user->email }}</p>
                                </div>
                                <div class="text-white/30 text-[10px] font-black uppercase tracking-widest">
                                    {{ $reg->created_at->format('M d, H:i') }}
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-white/30 font-black uppercase tracking-[0.3em] text-xs">No registrations yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Create/Edit Modal -->
    @if($showCreateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-6 backdrop-blur-md bg-black/40">
            <div class="glass-card w-full max-w-xl rounded-[3rem] p-12 border border-white/30 shadow-[0_0_100px_rgba(0,0,0,0.5)] transform animate-in fade-in zoom-in duration-300">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-3xl font-black text-white italic tracking-tighter uppercase">{{ $editingEventId ? 'Edit' : 'Create' }} <span class="text-[#002d5b]">Workshop</span></h3>
                    <button wire:click="$set('showCreateModal', false)" class="text-white/30 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit="{{ $editingEventId ? 'update' : 'store' }}" class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 ml-4">Workshop Title</label>
                        <input type="text" wire:model="title" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:outline-none focus:border-blue-400/50 transition-all font-bold">
                        @error('title') <span class="text-red-400 text-[10px] font-bold block ml-4">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 ml-4">Speaker</label>
                            <input type="text" wire:model="speaker" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:outline-none focus:border-blue-400/50 transition-all font-bold">
                            @error('speaker') <span class="text-red-400 text-[10px] font-bold block ml-4">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 ml-4">Total Seats</label>
                            <input type="number" wire:model="total_seats" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:outline-none focus:border-blue-400/50 transition-all font-bold">
                            @error('total_seats') <span class="text-red-400 text-[10px] font-bold block ml-4">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-[0.3em] text-white/40 ml-4">Location</label>
                        <input type="text" wire:model="location" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:outline-none focus:border-blue-400/50 transition-all font-bold">
                        @error('location') <span class="text-red-400 text-[10px] font-bold block ml-4">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#002d5b] text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-[#003d7b] shadow-2xl transition-all active:scale-95">
                            {{ $editingEventId ? 'Update Workshop' : 'Create Workshop' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>