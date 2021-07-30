<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodolistCollection;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todolists = Todolist::all();
        return (new TodolistCollection($todolists))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
            ]
        );

        $todolist = new Todolist();
        $todolist->name = $request->name;
        $todolist->save();

        Log::info("Tarefa {$todolist->id} cadastrado com sucesso.");

        return (new TodolistResource($todolist))->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist)
    {
        return (new TodolistResource($todolist))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todolist $todolist)
    {
        $request->validate(
            [
                'name' => 'required',
            ]
        );

        $todolist->name = $request->name;
        $todolist->save();

        Log::info("A tarefa com ID {$todolist->id} foi alterado");

        return (new TodolistResource($todolist))->response();
    }

    public function statusUpdate(Request $request, $id)
    {
        $todolist = Todolist::find($id);
        $todolist['status'] = $request->status;
        $todolist->save();

        Log::info("O status da tarefa com ID {$id} foi alterado");

        return response(
            [
                'message' => "Status Atualizado!!"
            ], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        $todolist->delete();

        Log::info("Tarefa de ID {$todolist->id} foi excluido");

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
