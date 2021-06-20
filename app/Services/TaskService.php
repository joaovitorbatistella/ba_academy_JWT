<?php

namespace App\Services;

use App\Exceptions\UserNotAllowedException;
use App\Models\Task;
use App\Models\User;

class TaskService
{

  /**
   * Handle task list
   * @param App\Models\User
   * @param string $q
   * @return array
   */
  public function list(
    User $user,
    string $q = ''
  )
  {
    if(!empty($q)){
      $tasks = $user->tasks()->where('label', 'LIKE', "%$q%")->get();
    }
    else
    {
      $tasks = $user->tasks;
    }

    return $tasks;
  }

  /**
   * Handle task creation
   * @param string $label
   * @param int $is_complete
   * @param int $user_id
   * @return App\Models\Task
   */
  public function create(
    string $label,
    int $is_complete,
    int $user_id
  )
  {
    $data = [
      'label'       => $label,
      'is_complete' => $is_complete,
      'user_id'     => $user_id,
    ];

    $task = Task::create($data);
    return $task;
  }

  /**
   * Handle task edition
   * @param App\Models\Task $task
   * @param string $label
   * @param int $is_complete
   * @param int $user_id
   * @return App\Models\Task
   */
  public function update(
    Task $task,
    string $label,
    int $is_complete,
    int $user_id
  )
  {
      $this->checkPermission($task, $user_id);

      $data = [
          'label'       => $label,
          'is_complete' => $is_complete,
      ];

      $task->fill($data);
      $task->save();

      return $task->fresh();
  }

  /**
   * Handle task delete
   * @param App\Models\Task $task
   * @param int $user_id
   * @return bool
   */
  public function destroy(
    Task $task,
    int $user_id
  )
  {
    $this->checkPermission($task, $user_id);
    return $task->delete();
  }

  /**
   * Handle user permission
   * @param App\Models\Task $task
   * @param int $user_id
   * @return void
   * @throws App\Exceptions\UserNotAllowedException
   */
  public function checkPermission(Task $task, int $user_id)
  {
    if($task->user_id != $user_id)
    {
      throw new UserNotAllowedException;
    }
  }
}