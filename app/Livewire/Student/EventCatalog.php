<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventCatalog extends Component
{
    public function register($eventId)
    {
        $user = Auth::user();

        // Check if already registered
        if ($user->registrations()->where('event_id', $eventId)->exists()) {
            $this->js("alert('You are already registered for this workshop.')");
            return;
        }

        // Check max 3 workshops
        if ($user->registrations()->count() >= 3) {
            $this->js("alert('You can only register for up to 3 workshops.')");
            return;
        }

        // Check seat availability
        $event = Event::withCount('registrations')->findOrFail($eventId);
        if ($event->registrations_count >= $event->total_seats) {
            $this->js("alert('Sorry, this workshop is already full.')");
            return;
        }

        // Perform registration
        \App\Models\Registration::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
        ]);

        $this->js("alert('Successfully registered for " . addslashes($event->title) . "')");
    }

    public function cancel($eventId)
    {
        Auth::user()->registrations()->where('event_id', $eventId)->delete();
        $this->js("alert('Registration cancelled.')");
    }

    public function render()
    {
        return view('livewire.student.event-catalog', [
            'events' => Event::withCount('registrations')->get(),
            'userRegistrations' => Auth::user()->registrations()->pluck('event_id')->toArray()
        ]);
    }
}
