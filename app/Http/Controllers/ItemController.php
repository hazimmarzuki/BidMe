<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ItemController extends Controller
{
    //
    public function create()
    {
        return view('additem');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'starting_price' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Convert duration from hours to seconds
        $validatedData['duration'] *= 3600;

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = 'images/' . $imageName;
        }

        Item::create($validatedData);

        return redirect()->route('show-items')->with('success', 'item created successfully!');
    }
    public function index()
{
    $items = Item::all();
    $itemsWithTimeRemaining = [];

    foreach ($items as $item) {
        $itemsWithTimeRemaining[] = [
            'item' => $item,
            'time_remaining' => $item->timeRemaining(),
        ];
    }

    return view('showitems', compact('itemsWithTimeRemaining'));
}

}
