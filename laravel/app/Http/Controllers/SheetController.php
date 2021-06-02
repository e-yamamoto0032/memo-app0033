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
        if (!$request->user()->can('update', $sheet)) {
            abort(403);
        }
        $sheet = Sheet::find($request->id);
        $sheet->fill($request->all())->save();
    }

    public function done(Request $request, Sheet $sheet)
    {
        if (!$request->user()->can('done', $sheet)) {
            abort(403);
        }
        $sheet = Sheet::find($request->id);
        $sheet->fill($request->all())->save();
    }

    public function store(SheetRequest $request)
    {
        if ($request->user_id !== Auth::id()) {
            abort(403);
        }
        $sheet = new Sheet();
        $sheet->fill($request->all())->save();
    }

    public function show($id)
    {
        $sheet = Sheet::find($id);

        if ($sheet->user_id !== Auth::id()) {
            abort(403);
        }
        return $this->jsonResponse($sheet);
    }

    public function destroy(Request $request, Sheet $sheet)
    {
        if (!$request->user()->can('destroy', $sheet)) {
            abort(403);
        }
        $sheet = Sheet::find($request->id);
        $sheet->delete();
    }
}
