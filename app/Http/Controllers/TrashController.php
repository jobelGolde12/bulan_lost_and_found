<?php

namespace App\Http\Controllers;

use App\Models\ItemCategories;
use App\Models\ItemModel;
use App\Models\TrashModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TrashController extends Controller
{
    // Show all trashed items
    public function index()
    {
        $trashedItems = TrashModel::onlyTrashed()->get();  
        Log::info('Trash => ' . $trashedItems);
        return Inertia::render('admin/trash/ItemTrash', ['items' => $trashedItems]);
    }

    public function trashItem($id)
    {
        $item = ItemModel::find($id);
        if (!$item) {
            return back()->with('error', 'Item not found.');
        }

        TrashModel::create([
          'user_id' => $item->user_id, 
          'lost_found_item_id' => $item->id, 
          'title' => $item->title,
          'description' => $item->description,
          'category' => $item->category_id,
          'status' => $item->status,
          'contact_info' => $item->owner_phone_number,
          'image_url' => $item->image_url,
          'deleted_at' => now(),
      ]);

        $item->delete();
        $categories = ItemCategories::all();
        $items = ItemModel::with('user:id,name', 'category:name,description')->get();
        return Inertia::render('admin/Home', [
          'categories' => $categories,
          'items' => $items,
        ]);
    }

    // Restore item from trash
    public function restore($id)
    {
        $trashedItem = TrashModel::find($id);
    
        if (!$trashedItem) {
            return back()->with('error', 'Item not found in trash.');
        }
    
        // Restore the item back to `items` table
        ItemModel::create([
            'id' => $trashedItem->lost_found_item_id,
            'user_id' => $trashedItem->user_id,
            'item_name' => $trashedItem->title,
            'item_description' => $trashedItem->description,
            'category_id' => $trashedItem->category,
            'status' => $trashedItem->status,
            'owner_phone_number' => $trashedItem->contact_info,
            'image_url' => $trashedItem->image_url,
        ]);
    
        $trashedItem->delete();
    
        return back()->with('success', 'Item restored successfully.');
    }

    // Permanently delete item
    public function destroy($id)
    {
        $trashedItem = TrashModel::onlyTrashed()->find($id);

        if (!$trashedItem) {
            return back()->with('error', 'Item not found.');
        }

        $trashedItem->forceDelete(); // Permanent deletion
        return back()->with('success', 'Item permanently deleted.');
    }
}
