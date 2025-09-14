<?php

namespace App\Livewire; // Define o namespace da classe

use Livewire\Component; // Importa o componente base do Livewire
use App\Models\Task; // Importa o modelo Task

class TodoList extends Component // Define o componente TodoList
{
    public $tasks = []; // Armazena a lista de tarefas
    public $title = ''; // Armazena o título da nova tarefa

    public function mount() // Método chamado ao inicializar o componente
    {
        $this->tasks = Task::orderByDesc('created_at')->get(); // Busca todas as tarefas ordenadas pela data de criação (mais recentes primeiro)
    }

    public function addTask() // Adiciona uma nova tarefa
    {
        $this->validate(['title' => 'required|string|min:2|max:200']); // Valida o campo título
        Task::create(['title' => $this->title, 'done' => false]); // Cria uma nova tarefa no banco de dados
        $this->title = ''; // Limpa o campo título
        $this->refreshTasks(); // Atualiza a lista de tarefas
    }

    public function toggleDone($id) // Alterna o status de conclusão da tarefa
    {
        if ($task = Task::find($id)) { // Busca a tarefa pelo id
            $task->update(['done' => ! $task->done]); // Atualiza o status 'done' para o oposto
            $this->refreshTasks(); // Atualiza a lista de tarefas
        }
    }

    public function deleteTask($id) // Exclui uma tarefa
    {
        if ($task = Task::find($id)) { // Busca a tarefa pelo id
            $task->delete(); // Exclui a tarefa do banco de dados
            $this->refreshTasks(); // Atualiza a lista de tarefas
        }
    }

    protected function refreshTasks() // Atualiza a lista de tarefas
    {
        $this->tasks = Task::orderByDesc('created_at')->get(); // Busca todas as tarefas ordenadas pela data de criação
    }

    public function render() // Renderiza a view do componente
    {
        return view('livewire.todo-list'); // Retorna a view 'livewire.todo-list'
    }
}
