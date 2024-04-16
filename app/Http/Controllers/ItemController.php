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
    public function create() //go to add item form
    {
        return view('additem');
    }

    public function store(Request $request) //store the item
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'countdown_date' => 'required|date_format:Y-m-d\TH:i|after:now',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/' . 'items_image'), $imageName);
            $validatedData['image'] = 'images/' . 'items_image/'. $imageName;
        }

        $validatedData['seller_id'] = Auth::id();


        Item::create($validatedData);

        return redirect()->route('profile')->with('success', 'item created successfully!');
    }

    public function index() //show all items
{
    $currentDateTime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    $buyer_id = Auth::id();

    $items = Item::where('countdown_date', '>', $currentDateTime )
    ->where('seller_id', '!=', $buyer_id)
    ->orderBy('countdown_date', 'asc')
    ->paginate(6);
    return view('showitems', compact('items'));
}

public function edit($id) //go to edit item form
{
    $item = Item::findOrFail($id);
    return view('edit-item', compact('item'));
}

public function update(Request $request, $id) //update the edited item
{

    $item = Item::findOrFail($id);


    $item->title = $request->title;
    $item->description = $request->description;
    $item->price = $request->price;
    $item->countdown_date = $request->countdown_date;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/' . 'items_image'), $imageName);
        $item->image = 'images/' . 'items_image/'. $imageName;
    }

$item->save();

return back()->with('success', 'item updated successfully');

}
public function destroy ($id) //delete an item
{

    $item = Item::findOrFail($id);
    unlink($item->image);
    $item->delete();

    return redirect()->route('profile')->with('success', 'item deleted successfully!');
}

public function bidview($id)
{
    $item = Item::findOrFail($id);
    return view('bid-view', compact('item'));
}

// public function bid(Request $request, $id)
// {
//     $item = Item::findOrFail($id);
// if($request->bid > $item->price) {
//     $validatedData = $request->validate([
//         'bid' => 'required|numeric|min:0',
//     ]);
//     $item->buyer_id = Auth::id();
//     $item->price = $request->bid;
//     $item->save();



//     return redirect()->route('bid-view', $id)->with('success', 'bid placed successfully!');

// }
// else{
//     return back()->with('error', 'you need to bid more than the current price');
// }
// }
}
