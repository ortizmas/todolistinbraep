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
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header bg-dark">
                    <a class="float-end" href="{{ route('todolists.index') }}"> <i
                            class="fa fa-arrow-alt-circle-left text-white"></i></a>
                    <h5 class="text-white">Alterar To-Do List</h5>

                </div>
                <div class="card-body">
                    @if (Session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{ route('todolists.update', $todolist) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="d-flex">
                            <input type="text" name="name" value="{{ $todolist->name}}" placeholder="Adicionar tarefa"
                                class="form-control rounded-0 @error('name') is-invalid @enderror " />
                            <button type="submit" class="btn btn-dark rounded-0 text-white">
                                Alterar
                            </button>
                        </div>
                        @error('name')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
