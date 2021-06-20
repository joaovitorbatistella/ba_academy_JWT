<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Services\TaskService;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * @var App\Services\TaskService
     */
    private $task_service;

    /**
     * Constructor
     * @param $task_service dependency injection
     */
    public function __construct(TaskService $task_service)
    {
        $this->task_service = $task_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(auth()->user()->tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $input = $request->validated();
        $task = $this->task_service->create(
            $input['label'],
            $input['is_complete'] ?? 0,
            auth()->user()->id
        );
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $input = $request->validated();
        $updated_task = $this->task_service->update(
            $task,
            $input['label'],
            $input['is_complete'],
            auth()->user()->id
        );
        return new TaskResource($updated_task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
