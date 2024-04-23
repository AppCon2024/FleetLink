<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ArchivesController extends Controller
{
    public function index(){
        $archives = User::all();
        return view('pages.archives',[
            'archives' => $archives
        ]);
    }
}
