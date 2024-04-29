<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jobs as jb;
use Exception;

class Jobtask extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $allJobTask = jb::with('user')->orderBy('id', 'desc')->get();
        // $allJobTask = $jb::orderBy('id', 'desc')->get();
        return response()->json(['error' => false, 'data' => $allJobTask, 'message' => 'success', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $jobs = new jb();
            $jobs->frequency = $request->frequency;
            $jobs->joburl = $request->joburl;
            $jobs->user_id = auth()->user()->id;
            $isJobSave = $jobs->save();
            if ($isJobSave)
                return response()->json(['error' => false, 'data' => $request->all(), 'message' => 'success', 'status' => true]);
            else
                return response()->json(['error' => false, 'data' => $request->all(), 'message' => 'something wrong', 'status' => false]);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'data' => [], 'message' => $e->getMessage(), 'status' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $delete = Jb::destroy($id);
            if ($delete)
                return response()->json(['error' => false, 'data' => [], 'message' => 'success', 'status' => true]);
            else
                return response()->json(['error' => false, 'data' => [], 'message' => 'something wrong', 'status' => false]);
          
        } catch (Exception $e) {
            return response()->json(['error' => true, 'data' => [], 'message' => $e->getMessage(), 'status' => false]);
        }
    }
}
