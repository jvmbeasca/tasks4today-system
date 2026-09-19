<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Welcome extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $data = [
            'title'      => 'Welcome',
            'currentDate' => date('F j, Y'),
            'tasks'      => $taskModel->getTodayTasks(),
        ];

        return view('welcome/index', $data);
    }
}