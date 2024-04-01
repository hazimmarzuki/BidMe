<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ItemController extends Controller
{
    //
    public function create()
    {
        return view('additem');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'starting_price' => 'required|numeric|min:0',
            'countdown_date' => 'required|date_format:Y-m-d\TH:i',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/' . 'items_image'), $imageName);
            $validatedData['image'] = 'images/' . 'items_image/'. $imageName;
        }
        $validatedData['user_id'] = Auth::id();

        Item::create($validatedData);

        return redirect()->route('show-items')->with('success', 'item created successfully!');
    }
    public function index()
{
    $currentDateTime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

    $items = Item::where('countdown_date', '>', $currentDateTime )
    ->orderBy('countdown_date', 'asc')
    ->paginate(6);
    return view('showitems', compact('items'));
}

}
