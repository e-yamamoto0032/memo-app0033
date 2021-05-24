<?php

namespace App\Http\Controllers;

use App\Sheet;
use Illuminate\Http\Request;
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

    public function update(Request $request)
    {
        $sheet = Sheet::find($request->id);

        $sheet->title = $request->title;
        $sheet->body = $request->body;
        $sheet->end_date = $request->end_date;
        $sheet->status = $request->status;
        $sheet->user_id = $request->user_id;
        $sheet->deadline = $request->deadline;
        $sheet->save();
    }


    public function store(Request $request)
    {
        $sheet = new Sheet();

        $sheet->title = $request->title;
        $sheet->body = $request->body;
        $sheet->deadline = $request->deadline;
        $sheet->status = $request->status;
        $sheet->user_id = $request->user_id;
        $sheet->save();

    }


}
