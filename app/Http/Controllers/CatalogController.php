<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
{
    $query = Card::where('status', 'approved')->with('user');
    
    if ($request->has('type') && in_array($request->type, ['share', 'wish'])) {
        $query->where('type', $request->type);
    }
    
    if ($request->has('search') && $request->search) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('author', 'like', "%{$search}%")
              ->orWhere('title', 'like', "%{$search}%");
        });
    }
    
    $cards = $query->orderBy('created_at', 'desc')->paginate(9);
    
    return view('catalog.index', compact('cards'));
}
}