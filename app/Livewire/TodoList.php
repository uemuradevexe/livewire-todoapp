<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TodoList extends Component
{
    public $tasks = [];
    public $title = '';

    public function mount()
    {
        $this->tasks = Task::orderByDesc('created_at')->get();
    }

    public function addTask()
    {
        $this->validate(['title' => 'required|string|min:2|max:200']);
        Task::create(['title' => $this->title, 'done' => false]);
        $this->title = '';
        $this->refreshTasks();
    }

    public function toggleDone($id)
    {
        if ($task = Task::find($id)) {
            $task->update(['done' => ! $task->done]);
            $this->refreshTasks();
        }
    }

    public function deleteTask($id)
    {
        if ($task = Task::find($id)) {
            $task->delete();
            $this->refreshTasks();
        }
    }

    protected function refreshTasks()
    {
        $this->tasks = Task::orderByDesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
