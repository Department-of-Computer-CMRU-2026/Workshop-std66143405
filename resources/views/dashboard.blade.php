<x-layouts::app :title="__('Dashboard')">
    <div class="py-6">
        @if(auth()->user()->role === 'admin')
            <livewire:admin.event-management />
        @else
            <livewire:student.event-catalog />
        @endif
    </div>
</x-layouts::app>
