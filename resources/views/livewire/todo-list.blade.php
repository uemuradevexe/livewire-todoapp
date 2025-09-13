<div>
    <form wire:submit.prevent="addTask" style="display:flex;gap:8px;margin-bottom:16px;">
        <input
            type="text"
            wire:model.defer="title"
            placeholder="Nova tarefa..."
            style="flex:1;padding:10px;border:1px solid #ddd;border-radius:8px;"
        >
        <button type="submit" style="padding:10px 14px;border:0;border-radius:8px;background:#111;color:#fff;">
            Adicionar
        </button>
    </form>

    @error('title')
        <div style="color:#b00020;margin-bottom:10px;">{{ $message }}</div>
    @enderror

    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px;">
        @forelse($tasks as $task)
            <li style="display:flex;align-items:center;gap:10px;padding:10px;border:1px solid #eee;border-radius:8px;">
                <input type="checkbox"
                       wire:click="toggleDone({{ $task->id }})"
                       @checked($task->done)
                >
                <span
                    @if($task->done)
                        style="text-decoration:line-through;color:#777;"
                    @endif
                >
                    {{ $task->title }}
                </span>
                <button wire:click="deleteTask({{ $task->id }})"
                        style="margin-left:auto;padding:6px 10px;border:1px solid #ddd;border-radius:6px;background:#fff;">
                    Excluir
                </button>
            </li>
        @empty
            <li style="color:#777;">Nenhuma tarefa ainda. Adicione a primeira! </li>
        @endforelse
    </ul>
</div>
