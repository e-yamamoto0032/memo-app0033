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
        // 認証が必要
        $this->middleware('auth');
    }

    public function index()
    {
        $sheets = Sheet::all();
        return $this->jsonResponse($sheets);
    }

    public function update(SheetRequest $request)
    {
        $sheet = Sheet::find($request->id);
        $sheet->fill($request->all())->save();
    }

    public function done(Request $request)
    {
        $sheet = Sheet::find($request->id);
        $sheet->fill($request->all())->save();
    }


    public function store(SheetRequest $request)
    {
        $sheet = new Sheet();
        $sheet->fill($request->all())->save();
    }


}
