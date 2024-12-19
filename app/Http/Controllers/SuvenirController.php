<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suvenir;
use File;

class SuvenirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ?? '';

        $suvenirs = Suvenir::where('name', 'LIKE', "%$keyword%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('suvenirs.index', compact('suvenirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suvenirs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|min:2|max:200',
            'short_description' => 'required',
            'price'             => 'required|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validation for image
        ]);

        $new_suvenir = new Suvenir();
        $new_suvenir->name              = $request->get('name');
        $new_suvenir->short_description = $request->get('short_description');
        $new_suvenir->price             = $request->get('price');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('suvenirs_image'), $imageName);
            $new_suvenir->image = $imageName;
        }

        $new_suvenir->save();

        return redirect()->route('suvenirs.index')->with('success', 'Souvenir successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suvenir = Suvenir::findOrFail($id);
        return view('suvenirs.edit', compact('suvenir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'              => 'required|min:2|max:200',
            'short_description' => 'required',
            'price'             => 'required|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validation for image
        ]);

        $suvenir = Suvenir::findOrFail($id);
        $suvenir->name              = $request->get('name');
        $suvenir->short_description = $request->get('short_description');
        $suvenir->price             = $request->get('price');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($suvenir->image) {
                $oldImagePath = public_path('suvenirs_image/' . $suvenir->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('suvenirs_image'), $imageName);
            $suvenir->image = $imageName;
        }

        $suvenir->save();

        return redirect()->route('suvenirs.index')->with('success', 'Souvenir successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $suvenir = Suvenir::findOrFail($id);

        // Delete the image file if it exists
        if ($suvenir->image) {
            $imagePath = public_path('suvenirs_image/' . $suvenir->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $suvenir->delete();

        return redirect()->route('suvenirs.index')->with('success', 'Souvenir successfully deleted.');
    }
}
