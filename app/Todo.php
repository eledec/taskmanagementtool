<?php

namespace App;

  use Illuminate\Support\Facades\Validator;
  use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todo';
    protected $fillable = ['todo','category','user_id','description'];
    
        public function __construct()
            {
                $this->middleware('auth');
            }
            
        
        
        protected function validator(array $request)
        {
            return Validator::make($request, [
                'todo' => 'required',
                'description' => 'required',
                'category' => 'required'
            ]);
        }
        
        public function create()
        {
            return view('todo.addtodo');
        }

        
        
}

    