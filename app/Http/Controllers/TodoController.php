<?php
namespace App\Http\Controllers;

use App\Todo;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  
    protected $redirectTo = '/todo';
   
   
   public function index()
    {
        $result = Auth::user()->todo()->get();
        if(!$result->isEmpty()){
            return view('todo.dashboard',['todos'=>$result,'image'=>Auth::user()->userimage]);
        }else{
            return view('todo.dashboard',['todos'=>false,'image'=>Auth::user()->userimage]);
        }
    }
   
  //get a validator for an incoming Todo request.
    protected function validator(array $request)
    {
        return Validator::make($request, [
            'todo' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);
    }
    
 //Show the form for creating a new task.
    public function create()
    {
        return view('todo.addtodo');
    }
    //saves a newly created task in storage.
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        
        if(Auth::user()->todo()->Create($request->all())){
            return $this->index();
        }
    }
    
    
  //Display all the tasks created.
    public function show(Todo $todo)
    {
        return view('todo.todo',['todo' => $todo]);
    }
    
  //Show the form for editing the specified task.
    public function edit(Todo $todo)
    {
        return view('todo.edittodo',['todo' => $todo]);
    }
    
   //Update the specified resource in storage.
    public function update(Request $request, Todo $todo)
    {
        $this->validator($request->all())->validate();
        if($todo->fill($request->all())->save()){
            return $this->show($todo);
        }
    }
    
   //Remove the specified resource from storage.
    public function destroy(Todo $todo)
    {
        if($todo->delete()){
            return back();
        }
    }
    
   
}
