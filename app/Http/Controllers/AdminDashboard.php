<?php

namespace App\Http\Controllers;

use App\Models\ItemCategories;
use App\Models\ItemModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminDashboard extends Controller
{
    public function index(){
        return Inertia::render('admin/Dashboard');
    }
    public function item(){
        $categories = ItemCategories::all();
        $items = ItemModel::with('user:id,name', 'category:name')->get();
            return Inertia::render('admin/Home', [
                'categories' => $categories,
                'items' => $items,
        ]); 
}
}
