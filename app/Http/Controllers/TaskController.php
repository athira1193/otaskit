<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use DataTables;
use App\Models\Employ;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $tasks = Task::latest()->get();
        if ($request->ajax()) {
            $event = Task::latest()->get();
            return Datatables::of($event)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="assign-task/' . $row->id . '" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-success btn-sm editPost">Assign Employee</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('task_list', ['tasks'=>$tasks]);   
        return view('task_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();
        return redirect()->back()->with('status', 'your message here');
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
        //
    }
    public function assignTask($id)
    {
        $task_id = $id;
        $employ = Employ::get();
        return view('assign_employ',compact("employ","task_id"));
    }
    public function assigned(Request $request)
    {
        dd($request->all());
    }
}
