<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function task1() {
        Storage::put('task1.txt', 'task 1 is completed');
    }
    public function task2() {
        Storage::put('task2.txt', 'task 2 is completed');
    }
    public function task3() {
        Storage::put('task3.txt', 'task 3 is completed');
    }
    public function task4() {   
        Storage::put('task4.txt', 'task 4 is completed');
    }
    public function task5() {   
        Storage::put('task5.txt', 'task 5 is completed');
    }
}
