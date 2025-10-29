<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $cards = Card::where('status', 'pending')->with('user')->get();
        return view('admin.index', compact('cards'));
    }

    public function approve(Card $card)
    {
        $card->update(['status' => 'approved']);
        return redirect()->route('admin.index')->with('success', 'Карточка одобрена.');
    }

    public function reject(Request $request, Card $card)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $card->update([
            'status' => 'rejected',
            'reason' => $request->reason,
        ]);

        return redirect()->route('admin.index')->with('success', 'Карточка отклонена.');
    }
}
