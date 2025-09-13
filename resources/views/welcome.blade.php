<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do com Livewire</title>
    @livewireStyles
</head>
<body style="max-width:720px;margin:40px auto;font-family:system-ui,Arial;">
    <h1>To-Do List</h1>

    {{-- Escolha UMA das chamadas abaixo (remova as outras) --}}
    <livewire:todo-list />
    {{-- @livewire('todo-list') --}}
    {{-- @livewire(\App\Livewire\TodoList::class) --}}

    @livewireScripts
</body>
</html>
