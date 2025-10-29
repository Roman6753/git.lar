<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activeCards = $user->cards()->whereIn('status', ['pending', 'approved'])->get();
        $archivedCards = $user->cards()->whereIn('status', ['rejected', 'archived'])->get();

        return view('cards.index', compact('activeCards', 'archivedCards'));
    }

    public function create()
    {
        return view('cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'type' => 'required|in:share,wish',
        ]);

        Card::create([
            'user_id' => Auth::id(),
            'author' => $request->author,
            'title' => $request->title,
            'type' => $request->type,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'binding' => $request->binding,
            'condition' => $request->condition,
            'status' => 'pending',
        ]);

        return redirect()->route('cards.index')->with('success', 'Карточка отправлена на модерацию.');
    }

    public function destroy(Card $card)
    {
        if ($card->user_id !== Auth::id()) {
            abort(403);
        }

        $card->update(['status' => 'archived']);

        return redirect()->route('cards.index')->with('success', 'Карточка архивирована.');
    }
}