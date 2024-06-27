<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $galleries = Gallery::all();
        return view('galleries.index',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        if ($request->hasFile('image')) {
            $data = $request->validated();

                $data['caption'] = $request->input('caption');

                    $file=$request->file('image');
                    $filename=time().'.'.$file->getClientOriginalExtension();
                    $file->move('uploads/galleries/images/',$filename);
                    $data['image']=$filename;
               
                // $data['image'] = Storage::putFile('galleries',$request->file('image'));
                $data['user_id'] = auth()->id();
            
            Gallery::create($data);

            return to_route('galleries.index')->with('message','Gallery Added Successfully!');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
