<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employ;
use DataTables;

class EmployessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $employee = Employ::latest()->get();
        if ($request->ajax()) {
            $event = Employ::latest()->get();
            return Datatables::of($event)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="invite-event/' . $row->id . '" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-success btn-sm editPost">Assign Employee</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('employ_list', ['employee'=>$employee]);   
        return view('employ_list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get();
        return view('new_employee',compact("departments"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employ = new Employ();
        $employ->emp_name = $request->name;
        $employ->mobile = $request->mobile;
        $employ->dept_id  = $request->department;
        $employ->save();
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
}
