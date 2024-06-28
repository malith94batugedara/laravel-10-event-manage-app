<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id,Event $event)
    {
        $event = Event::findOrFail($id);

        $like = $event->likes()->where('user_id',auth()->id())->first();

        $savedEvent = $event->savedEvents()->where('user_id', auth()->id())->first();

        $attending = $event->bookings()->where('user_id', auth()->id())->first();

        return view('events.show',compact('event','like','savedEvent','attending'));
    }
}
