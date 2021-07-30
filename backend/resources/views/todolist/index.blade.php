@extends('layouts.app')

@section('page-styles')
<style>
    .pointer {
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="text-white">To-do List</h5>
                </div>
                <div class="card-body">
                    @if (Session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{ route('todolists.store') }}" method="post">
                        @csrf
                        <div class="d-flex">
                            <input type="text" name="name" placeholder="Adicionar tarefa"
                                class="form-control rounded-0 @error('name') is-invalid @enderror " />
                            <button type="submit" class="btn btn-dark rounded-0 text-white">
                                Salvar
                            </button>
                        </div>
                        @error('name')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </form>
                </div>

                <!-- Table task -->
                <div class="card-body">
                    <table class="table" id="todoList">
                        <thead>
                            <tr>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todolists as $value)
                            <tr id="row_todoList_{{ $value->id }}">
                                <td>
                                    <span
                                        class="{{ ($value->status === 'finished') ? 'text-decoration-line-through' : ''}}">{{ $value->name }}</span>
                                </td>
                                <td>
                                    @if ($value->status === 'to-do')
                                    <span class="badge bg-warning pointer text-center text-capitalize"
                                        id='rbutton_{{ $value->id }}'
                                        onclick="updateStatusTask({{ $value->id }});">Pendência</span>
                                    @elseif($value->status === 'in-progress')
                                    <span class="badge bg-info pointer text-center text-capitalize"
                                        id='rbutton_{{ $value->id }}' onclick="updateStatusTask({{ $value->id }});">Em
                                        progresso</span>
                                    @else
                                    <span class="badge bg-success pointer text-center text-capitalize"
                                        id='rbutton_{{ $value->id }}'
                                        onclick="updateStatusTask({{ $value->id }});">Finalizado</span>
                                    @endif

                                </td>
                                <td class=" text-center">
                                    <a href="{{ route('todolists.edit', $value->id) }}" class="pointer text-dark">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('todolists.destroy', $value->id) }}" id="btn-delete"
                                        class="pointer text-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script>
    function updateStatusTask(i) {
        axios.put(`/todolists/status/${i}`)
        .then(function (response) {
            window.setTimeout(function(){window.location.reload()}, 0);
        })
        .catch(function (error) {
            console.log(error);
        });
        console.log(i);
    }

    $(document).ready(function(){
        $('body').on('click', '#btn-delete', function (event) {
            event.preventDefault();

            var me = $(this),
            url = me.attr('href')
            csrf_token = $('meta[name="csrf-token"]').attr('content');

            axios.post(url, {
                _method: 'DELETE',
                '_token': csrf_token
            })
            .then( response => {
                var hideId = 'table#todoList tr#row_todoList_' + response.data.id;
                $(hideId).remove();
                $(hideId).hide();
            })
            .catch( error => {
                cosole.log(error);
            })
        });
    });
</script>
@endsection
