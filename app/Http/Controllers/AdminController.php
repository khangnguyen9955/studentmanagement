<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function studentList(){
        return view('pages.Admin.student-list');
    }
}