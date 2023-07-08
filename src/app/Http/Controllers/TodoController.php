<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::getAllTasks();
        Log::debug("TODOS");
        Log::debug($todos);

        return response()->json([
            "todos" => $todos
        ], 200);
    }

    public function create(Request $request)
    { 
        //requestをデバッグする時は普通にこの形で
        // return $request;

        try{
            $todo = Todo::createTask($request);
        }catch(\Exception $e){
            return response()->json([
                "status" => 500,
                "error_message" => $e->getMessage()
            ], 500);
        }

        return response()->json([
            "message" => "create success",
            "todo" => $todo
        ], 201);
    }

    public function show($id)
    {
        $todo = Todo::getTask($id);
        return response()->json([
            "todo" => $todo
        ], 200);
    }

    public function update(Request $request, $id)
    {
        try{
            $todo = Todo::updateTask($request,$id);
        }catch(\Exception $e){
            return response()->json([
                "status" => 500,
                "error_message" => $e->getMessage()
            ], 500);
        }
        
        return response()->json([
            "todo" => $todo
        ], 200);
    }

    public function delete($id)
    {
        try{
            $message = Todo::deleteTask($id);
        }catch(\Exception $e){
            return response()->json([
                "status" => 500,
                "error_message" => $e->getMessage()
            ], 500);
        }
        
        return response()->json([
            "message" => $message
        ], 200);
    }

    public function search($word)
    {
        $todos = Todo::SearchTasks($word);
        return response()->json([
            "todos" => $todos
        ], 200);
    }
}