<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolists = Todolist::all();
        return view('todolist.index', compact('todolists'));
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
                'name' => 'required'
            ]
        );

        Todolist::create($request->all());

        return redirect()->route('todolists.index')
            ->with('success', 'Adicionado com sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        $todolist = Todolist::find($todolist->id);
        return view('todolist.edit', compact('todolist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todolist $todolist)
    {
        Todolist::find($todolist->id)->update($request->all());

        return redirect()->route('todolists.index')
            ->with('success', 'Alterado com sucesso');
    }

    public function updateStatus($id)
    {
        $todolist = Todolist::findOrFail($id);
        if ($todolist->status == 'to-do') {
            $todolist['status'] = 'in-progress';
            $todolist->save();
        } else if ($todolist->status == 'in-progress') {
            $todolist['status'] = 'finished';
            $todolist->save();
        } else {
            $todolist['status'] = 'to-do';
            $todolist->save();
        }

        return response()->json(
            [
                'id' => $todolist->id,
                'status' => 200
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        Todolist::findOrFail($todolist->id)->delete();

        return response()->json(
            [
                'id' => $todolist->id,
                'status' => 200
            ]
        );
    }
}
