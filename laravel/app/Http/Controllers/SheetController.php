<?php

namespace App\Http\Controllers;

use App\Sheet;
use Illuminate\Http\Request;
use App\Http\Requests\SheetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SheetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sheets = Sheet::all();
        return $this->jsonResponse($sheets);
    }

    public function update(SheetRequest $request, Sheet $sheet)
    {
        if ($request->user()->can('update', $sheet)) {
            $sheet = Sheet::find($request->id);
            $sheet->fill($request->all())->save();
        } else {
            abort(403);
        }
    }

    public function done(Request $request, Sheet $sheet)
    {
        if ($request->user()->can('done', $sheet)) {
            $sheet = Sheet::find($request->id);
            $sheet->fill($request->all())->save();
        } else {
            abort(403);
        }
    }


    public function store(SheetRequest $request)
    {
        if ($request->user_id === Auth::id()) {
            $sheet = new Sheet();
            $sheet->fill($request->all())->save();
        } else {
            abort(403);
        }
    }

    public function destroy(Request $request, Sheet $sheet)
    {
        if ($request->user()->can('destroy', $sheet)) {
            $sheet = Sheet::find($request->id);
            $sheet->delete();
        } else {
            abort(403);
        }
    }
}
