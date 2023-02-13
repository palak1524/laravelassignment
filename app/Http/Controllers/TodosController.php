<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class TodosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $todos = Todo::all();
        $todos = Todo::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('home', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_todo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'date_time'=>'required',

        ] );
        // $date=new DateTime();
        // $date->format("Y-m-d");

        $todo=new Todo;
        $todo->title=$request->input('title');
        $todo->description=$request->input('description');
        // $todo->date_time=$date;
        $todo->date_time=date("Y-m-d H:i", strtotime($request->date_time));
        $todo->user_id = Auth::user()->id;
        
        $todo->save(); 
        
        return back()->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('delete_todo', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('edit_todo', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate($request,[
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'date_time'=>'required',
          
        ] );
        $todo=Todo::find($id);
        $todo->title=$request->input('title');
        $todo->description=$request->input('description');
        // $todo->date_time=$date;
        $todo->date_time=date("Y-m-d H:i", strtotime($request->date_time));
        $todo->save(); 
        
        return back()->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     // $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
    //     // $todo->delete();
    //     // return redirect()->route('todo.index')->with('success', 'Item deleted successfully');

    public function delete($id)
    {
        Todo::find($id)->delete();
  
        return response()->json(['success'=>'Item Deleted Successfully!']);
    }
}
