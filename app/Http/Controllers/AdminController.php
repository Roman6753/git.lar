<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->login !== 'admin') {
            abort(403, 'Доступ запрещен.');
        }

        $cards = Card::where('status', 'pending')->with('user')->get();
        return view('admin.index', compact('cards'));
    }

    public function approve(Card $card)
    {
        if (Auth::user()->login !== 'admin') {
            abort(403, 'Доступ запрещен.');
        }

        $card->update(['status' => 'approved']);
        return redirect()->route('admin.index')->with('success', 'Карточка одобрена и теперь видна в каталоге.');
    }

    public function reject(Request $request, Card $card)
    {
        if (Auth::user()->login !== 'admin') {
            abort(403, 'Доступ запрещен.');
        }

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
