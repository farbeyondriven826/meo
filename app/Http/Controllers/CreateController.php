<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Index', [
            'queue'=> User::with('client')->where('isAdmin',1)->get()
        ]);
    }
    public function create(){
        return Inertia::render('Admin/Create');
    }
}
