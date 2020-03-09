<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Task::orderBy('order', 'ASC')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $task = Task::create($request->all());

        return response()->json([
            'message' => 'Task created successfully!',
            'data' => $task,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        // if ($task->board_id != $boardId) {
        //     return response()->json('Unauthorized!', 401);
        // }
        
        $data = Task::with('cards')->findOrFail($task->id);
        
        // $task = $task->orderBy('order', 'ASC')->get();

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTaskRequest $request, Task $task)
    {  
        $task->update($request->all());
        
        return response()->json([
            'message' => 'Task updated successfully!',
            'data' => $task,
        ], 200);
    }

    public function changeTaskOrder(Task $task, $order, $board_id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (Task::findOrFail($task->id)) {
            $task->delete();

            return response()->json('Deleted task!', 200);
        }
    }
}
