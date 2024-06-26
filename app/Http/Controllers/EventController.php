<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Country;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $events = Event::all();
        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.create',compact('countries','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        if($request->hasFile('image')){
            
            $data = $request->validated();

            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/events/images',$filename);
            $data['image']=$filename;

            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($request->title);

            $event = Event::create($data);
            $event->tags()->attach($request->tags);
            return redirect(route('events.index'))->with('message','Event Added Successfully!');
        }
        else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event):View
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.edit',compact('countries','tags','event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event):RedirectResponse
    {
        $data = $request->validated();

        if($request->hasFile('image')){

                $destination ='uploads/events/images/'.$event->image;
                if(File::exists($destination)){
                     File::delete($destination);
                }
    
                 $file=$request->file('image');
                 $filename=time().'.'.$file->getClientOriginalExtension();
                 $file->move('uploads/events/images/',$filename);
                 $data['image']=$filename;
            
        }
                 $data['slug'] = Str::slug($request->title);

                 $event->update($data);
                 $event->tags()->sync($request->tags);
                 return redirect(route('events.index'))->with('message','Event Updated Successfully!');
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $destination ='uploads/events/images/'.$event->image;
            if(File::exists($destination)){
                 File::delete($destination);
            }
        $event->tags()->detach();
        $event->delete();
        return redirect(route('events.index'))->with('message','Event Deleted Successfully!');
    }
}
