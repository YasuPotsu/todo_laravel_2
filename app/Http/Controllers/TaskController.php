<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * タスクリポジトリ
     * 
     * @var TaskRepository
     */
    protected $tasks;


    /**
     * タスクコンストラクタ
     * 
     * @return void
     */

     public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * タスク一覧
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $tasks = Task::orderBy('created_at', 'asc')->get();
        // 認証済みのユーザー情報の取得
        // $tasks = $request->user()->tasks()->get();
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * タスク登録
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // タスク作成
        // Task::create([
        //    'user_id' => 0,
        //     'name' => $request->name
        // ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task)
    {
        //
    }


   /**
       * タスク削除
       *
       * @param Request $request
       * @param Task $task
       * @return Response
       */
      public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();
        return redirect('/tasks');
    }
}
