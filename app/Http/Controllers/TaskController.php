<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use DataTables;
use App\Models\Employ;
use App\Models\TaskToEmployee;
use Illuminate\Support\Facades\Mail;

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
        return redirect()->route('tasks.index')
        ->with('status', 'Task Created Successfully');
        //return redirect()->back()->with('status', 'your message here');
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
        //dd($request->all());
        $employ = Employ::where('id', $request->emp_name)->first();
        $task = Task::where('id', $request->task_id)->first();
        $details = array('name'=>$employ->emp_name,'task'=>$task->title);
        $sender_data = array('email' => $request->emp_email);

        Mail::send('emails.MailtoEmploy', $details, function ($message)use($sender_data){

            $message->to($sender_data['email'], 'Receiver Name');
            $message->subject('Task Assigned');
            $message->from('athira1193@gmail.com', 'ORISIS');
        });
        $task_to_emp = new TaskToEmployee();
        $task_to_emp->task_id = $task->id;
        $task_to_emp->emp_id = $employ->id;
        $task_to_emp->status = 'assigned';
        $task_to_emp->save();
        Task::where('id', $task->id)
       ->update([
           'status' => 'assigned'
        ]);
        return redirect()->route('tasks.index')
        ->with('status', 'Task updated Successfully');
        //echo "Basic Email Sent. Check your inbox.";
    }
}
