<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title','is_complete'];

    // インスタンスを生成しなくてもアクセス可能にするために静的メンバにします。
    // public function → public static function
    public static function getAllTasks()
    {
        $tasks = Todo::all();
        return $tasks;
    }

    public static function getTask($id)
    {
        $task = Todo::find($id);
        return $task;
    }

    public static function createTask(Request $request)
    {
        $task= Todo::create([
            'title' => $request->title,
            'is_complete' => false
        ]);
        return $task;
    }

    public static function updateTask(Request $request, $id)
    {
        $task = Todo::find($id);
        $task->title = $request->title;
        $task->save();
        return $task;
    }

    public static function deleteTask($id)
    {
        $task = Todo::find($id);
        Log::debug($task);
        if($task){
            $task->delete();
            return "delete success";
        }else{
            return "taskは存在しません" ;
        };
    }

    public static function searchTasks($word)
    {
        $tasks = Todo::where('title', 'LIKE', '%'.$word.'%')->get();
        return $tasks;
    }

}

