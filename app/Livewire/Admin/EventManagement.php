<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventManagement extends Component
{
    public $showCreateModal = false;
    public $showRegistrantsModal = false;
    public $editingEventId = null;
    public $viewingEvent = null;

    // Form fields
    public $title = '';
    public $speaker = '';
    public $location = '';
    public $total_seats = 0;

    protected $rules = [
        'title' => 'required|string|max:255',
        'speaker' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'total_seats' => 'required|integer|min:1',
    ];

    public function showRegistrants($id)
    {
        $this->viewingEvent = Event::with('registrations.user')->findOrFail($id);
        $this->showRegistrantsModal = true;
    }

    public function create()
    {
        $this->reset(['title', 'speaker', 'location', 'total_seats', 'editingEventId']);
        $this->showCreateModal = true;
    }

    public function store()
    {
        $this->validate();

        Event::create([
            'title' => $this->title,
            'speaker' => $this->speaker,
            'location' => $this->location,
            'total_seats' => $this->total_seats,
        ]);

        $this->showCreateModal = false;
        $this->js("alert('Workshop created successfully!')");
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $this->editingEventId = $id;
        $this->title = $event->title;
        $this->speaker = $event->speaker;
        $this->location = $event->location;
        $this->total_seats = $event->total_seats;
        $this->showCreateModal = true;
    }

    public function update()
    {
        $this->validate();

        $event = Event::findOrFail($this->editingEventId);
        $event->update([
            'title' => $this->title,
            'speaker' => $this->speaker,
            'location' => $this->location,
            'total_seats' => $this->total_seats,
        ]);

        $this->showCreateModal = false;
        $this->js("alert('Workshop updated successfully!')");
    }

    public function delete($id)
    {
        Event::findOrFail($id)->delete();
        $this->js("alert('Workshop deleted.')");
    }

    public function render()
    {
        return view('livewire.admin.event-management', [
            'events' => Event::withCount('registrations')->get(),
            'totalRegistrations' => \App\Models\Registration::count(),
            'overview' => DB::table('events')
            ->leftJoin('registrations', 'events.id', '=', 'registrations.event_id')
            ->select(
            'events.id',
            'events.title',
            'events.total_seats',
            DB::raw('count(registrations.id) as registrations_count')
        )
            ->groupBy('events.id', 'events.title', 'events.total_seats')
            ->get()
        ]);
    }
}
