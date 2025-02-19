<?php

namespace App\Http\Controllers;

use App\Models\TrashModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrashController extends Controller
{
    public function index(){
        return Inertia::render('Settings/Trash');
    }
    public function restore($id)
{
    $trashedItem = TrashModel::withTrashed()->find($id);

    if (!$trashedItem) {
        return back()->with('error', 'Item not found.');
    }

    // Restore item and remove from trash
    $trashedItem->restore();

    return back()->with('success', 'Item restored successfully.');
}

}
