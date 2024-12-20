<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use File;

class GalleryController extends Controller
{
    /**
     * Display a listing of the gallery images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';

        $galleries = Gallery::where('alt', 'LIKE', "%$keyword%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery image.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created gallery image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'image' => 'required|image',
            'alt'   => 'nullable|string|max:255',
        ])->validate();

        $gallery = new Gallery;
        
        if ($request->file('image')) {
            $filename = time() . "_" . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->move('gallery_images', $filename);
            $gallery->image = $filename;
        }

        // Set alt text or use default
        $gallery->alt = $request->get('alt', 'Kuliner Mojopahit'); // Default alt text

        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Gallery image successfully created');
    }

    /**
     * Display the specified gallery image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified gallery image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($request->file('image')) {
            // Delete old image if exists
            if ($gallery->image) {
                File::delete('gallery_images/' . $gallery->image);
            }

            $filename = time() . "_" . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->move('gallery_images', $filename);
            $gallery->image = $filename;
        }

        $gallery->alt = $request->get('alt', 'Kuliner Mojopahit'); // Default alt text

        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Gallery image successfully updated.');
    }

    /**
     * Remove the specified gallery image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'Gallery deleted successfully!');
    }

}
