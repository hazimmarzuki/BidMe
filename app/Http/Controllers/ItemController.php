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
            'category' => 'required',
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

        return redirect()->route('profile-square')->with('success', 'item created successfully!');
    }

    public function indexSquare() //show all items
{
    $currentDateTime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    $buyer_id = Auth::id();

    $items = Item::where('countdown_date', '>', $currentDateTime )
    ->where('seller_id', '!=', $buyer_id)
    ->withCount('bids')
    ->orderBy('countdown_date', 'asc')
    ->paginate(6);

    $category = session()->get('category', 'All Items'); // retrieve the selected category from session
    session()->put('previousUrl', 'square');

    return view('showitemssquare', compact('items', 'category'));
}

public function indexList() //show all items
{
    $currentDateTime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    $buyer_id = Auth::id();

    $items = Item::where('countdown_date', '>', $currentDateTime )
    ->where('seller_id', '!=', $buyer_id)
    ->withCount('bids')
    ->orderBy('countdown_date', 'asc')
    ->get();

    $category = session()->get('category', 'All Items'); // retrieve the selected category from session
    session()->put('previousUrl', 'list');

    return view('showitemslist', compact('items', 'category'));
}




public function search(Request $request)
{
    $request->validate([
        'search' => 'nullable|string',
        'category' => 'required|string',
    ]);

    $previousUrl = session()->get('previousUrl');

    $search = $request->input('search');
    $category = $request->input('category');
    session()->put('category', $category); // store the selected category in session

    $currentDateTime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    $buyer_id = Auth::id();

    $items = Item::where('countdown_date', '>', $currentDateTime)
        ->where('seller_id', '!=', $buyer_id);

    if ($search) {
        $items->where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        });
    }

    $items->when($category != 'All Items', function ($query) use ($category) {
        $query->where('category', $category);
    });

    $items = $items->withCount('bids')
        ->orderBy('countdown_date', 'asc')
        ->paginate(6);

        if ($items->count() == 0) {
            // Pass the category back with the error message
            return redirect()->back()->withInput()->with('error', 'There are no results for your search.');
        } else {
            // Determine which view to return based on the previous URL
            $previousUrl = session()->get('previousUrl', 'square'); // default to 'square' if not set
            $view = ($previousUrl === 'list') ? 'showitemslist' : 'showitemssquare';
            return view($view, compact('items', 'category'))->with('success', 'Here are the results for your search.');
        }
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
    $item->category = $request->category;
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

return redirect()->route('profile-square')->with('success', 'Item updated successfully');

}
public function destroy ($id) //delete an item
{

    $item = Item::findOrFail($id);
    unlink($item->image);
    $item->delete();

    return redirect()->route('profile-square')->with('success', 'item deleted successfully!');
}



public function itemview($id)
    {
        $item = Item::withCount('bids')
        ->findOrFail($id);
        return view('item-view', compact('item'));
    }
}
