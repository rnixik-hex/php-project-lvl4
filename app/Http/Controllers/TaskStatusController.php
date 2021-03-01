<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('task-status.index', [
            'taskStatuses' => TaskStatus::query()->orderByDesc('id')->limit(100)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        return $this->validateAndSaveTaskStatus(new TaskStatus(), $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function update(Request $request, string $id)
    {
        /** @var TaskStatus $taskStatus */
        $taskStatus = TaskStatus::query()->findOrFail((int) $id);
        return $this->validateAndSaveTaskStatus($taskStatus, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        $taskStatus = TaskStatus::query()->find((int) $id);
        if ($taskStatus) {
            $taskStatus->delete();
        }

        flash(__('Status has been deleted'))->success();

        /* @phpstan-ignore-next-line */
        return redirect()
            ->route('task_statuses.index');
    }

    private function validateAndSaveTaskStatus(TaskStatus $taskStatus, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            flash(__('Incorrect name'))->error();

            /* @phpstan-ignore-next-line */
            return redirect()
                ->back()
                ->withInput();
        }

        $taskStatus->name = $request->get('name');
        $taskStatus->save();

        flash(__('Status has been saved'))->success();

        /* @phpstan-ignore-next-line */
        return redirect()
            ->route('task_statuses.show', ['task_status' => $taskStatus->id]);
    }
}
