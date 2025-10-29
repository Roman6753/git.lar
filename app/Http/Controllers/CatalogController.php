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
        
        $cards = $query->get();
        
        return view('catalog.index', compact('cards'));
    }
}