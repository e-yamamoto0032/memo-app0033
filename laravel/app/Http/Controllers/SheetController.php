<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSheet;
use App\Sheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SheetController extends Controller
{
//    public function __construct()
//    {
//        // 認証が必要
//        $this->middleware('auth');
//    }

    public function index(){

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $sheet = new Sheet();

        $sheet->title = $request->title;
        $sheet->body = $request->body;
        $sheet->deadline = $request->deadline;
        $sheet->save();

    }
}
