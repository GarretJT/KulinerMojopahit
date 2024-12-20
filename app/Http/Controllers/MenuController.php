<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Destination; // For tenant_id relationship
use File;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword') ?? '';

        $menus = Menu::where('name', 'LIKE', "%$keyword%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinations = Destination::all(); // Fetch destinations for tenant selection
        return view('menu.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tenant_id'         => 'required|exists:destinations,id', // Validate tenant_id references destinations
            'name'              => 'required|min:2|max:200',
            'price'             => 'required|numeric|min:0',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validation for image
        ]);

        $newMenu = new Menu();
        $newMenu->tenant_id = $request->get('tenant_id');
        $newMenu->name = $request->get('name');
        $newMenu->price = $request->get('price');
        $newMenu->description = $request->get('description');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('menus_image'), $imageName);
            $newMenu->image = $imageName;
        }

        $newMenu->save();

        return redirect()->route('menu.index')->with('success', 'Menu item successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $destinations = Destination::all(); // Fetch destinations for tenant selection
        return view('menu.edit', compact('menu', 'destinations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tenant_id'         => 'required|exists:destinations,id', // Validate tenant_id references destinations
            'name'              => 'required|min:2|max:200',
            'price'             => 'required|numeric|min:0',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validation for image
        ]);

        $menu = Menu::findOrFail($id);
        $menu->tenant_id = $request->get('tenant_id');
        $menu->name = $request->get('name');
        $menu->price = $request->get('price');
        $menu->description = $request->get('description');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($menu->image) {
                $oldImagePath = public_path('menus_image/' . $menu->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('menus_image'), $imageName);
            $menu->image = $imageName;
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu item successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Delete the image file if it exists
        if ($menu->image) {
            $imagePath = public_path('menus_image/' . $menu->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu item successfully deleted.');
    }
}
