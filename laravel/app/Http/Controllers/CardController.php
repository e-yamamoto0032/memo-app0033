<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use App\Http\Requests\CardRequest;
use Illuminate\Support\Facades\Auth;


class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cards = Card::all();
        return $this->jsonResponse($cards);
    }

    public function store(CardRequest $request)
    {
        if ($request->user_id !== Auth::id()) {
            abort(403);
        }
        $card = new Card();
        $card->fill($request->all())->save();
    }

    public function destroy(Request $request)
    {
        if ($request->user_id !== Auth::id()) {
            abort(403);

        }
        $task = Card::find($request->id);
        $task->delete();
    }
}
