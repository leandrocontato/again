@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Minhas Tarefas</h1>
        <hr>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>
                                    @if($task->editing)
                                        <input type="text" name="title" value="{{ $task->title }}" class="form-control">
                                    @else
                                        {{ $task->title }}
                                    @endif
                                </td>
                                <td>
                                    @if($task->completed)
                                        Concluída
                                    @else
                                        Pendente
                                    @endif
                                </td>
                                <td>
                                    @if($task->editing)
                                        <button class="btn btn-primary btn-save" data-id="{{ $task->id }}">Salvar</button>
                                        <button class="btn btn-default btn-cancel" data-id="{{ $task->id }}">Cancelar</button>
                                    @else
                                        <button class="btn btn-primary btn-edit" data-id="{{ $task->id }}">Editar</button>
                                        <button class="btn btn-danger btn-delete" data-id="{{ $task->id }}">Excluir</button>
                                        <button class="btn btn-success btn-complete" data-id="{{ $task->id }}">Concluir</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form id="form-add-task" action="{{ url('tasks') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Nova Tarefa:</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('.btn-delete').click(function() {
                var taskId = $(this).data('id');
                if(confirm('Tem certeza que deseja excluir esta tarefa?')) {
                    $.ajax({
                        url: '/api/tasks/' + taskId,
                        type: 'DELETE',
                        success: function() {
                            window.location.reload();
                        }
                    });
                }
            });

            $('.btn-edit').click(function() {
                var taskId = $(this).data('id');
                $('tr').each(function() {
                    if($(this).find('.btn-edit').data('id') == taskId) {
                        $(this).find('input[type="text"]').show().focus();
                        $(this).find('.btn-edit').hide();
                        $(this).find('.btn-delete').hide();
                        $(this).find('.btn-complete').hide();
                        $(this).find('.btn-save').show();
                        $(this).find('.btn-cancel').show();
                        $(this).find('td').eq(1).html('');
                        $(this).find('input[type="text"]').val('');
                    }
                }
            });
        });

        $('.btn-save').click(function() {
            var taskId = $(this).data('id');
            var taskTitle = $(this).closest('tr').find('input[type="text"]').val();
            $.ajax({
                url: '/api/tasks/' + taskId,
                type: 'PUT',
                data: {
                    title: taskTitle
                },
                success: function() {
                    window.location.reload();
                }
            });
        });

        $('.btn-cancel').click(function() {
            var taskId = $(this).data('id');
            $('tr').each(function() {
                if($(this).find('.btn-cancel').data('id') == taskId) {
                    $(this).find('input[type="text"]').hide();
                    $(this).find('.btn-edit').show();
                    $(this).find('.btn-delete').show();
                    $(this).find('.btn-complete').show();
                    $(this).find('.btn-save').hide();
                    $(this).find('.btn-cancel').hide();
                    $(this).find('td').eq(1).html('Pendente');
                }
            });
        });

        $('.btn-complete').click(function() {
            var taskId = $(this).data('id');
            $.ajax({
                url: '/api/tasks/' + taskId + '/complete',
                type: 'PUT',
                success: function() {
                    window.location.reload();
                }
            });
        });

        $('#form-add-task').submit(function(event) {
            event.preventDefault();
            var taskTitle = $('#title').val();
            $.ajax({
                url: '/api/tasks',
                type: 'POST',
                data: {
                    title: taskTitle
                },
                success: function() {
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection
