<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    /**---------
     *  INDEX
    ------------*/
    public function index() {

        $tasks = Task::all();

        return response()->json([
            'data' => $tasks,
            'message' => 'Tasks encontrados correctamente'
        ]);
        
    }

    /**--------
     * STORE
    -----------*/
    public function store(Request $request) {

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = Task::create($data);

        return response()->json(['data' => $task], 201);
    }

    /**-------
     * SHOW
    ----------*/
    public function show($id) {

        $task = Task::findOrFail($id);

        return response()->json([
            "data" => $task,
            "message" => "Task encontrado correctamente"
        ], 200);

    }

    /**---------
     * UPDATE
    ------------*/
    public function update($id, Request $request) {

        $task = Task::where('id', $id)->update($request->all());

        return response()->json([
            "data" => $request->all(),
            "message" => "Task actualizado correctamente"
        ], 200);

    }

    /**----------
     * DESTROY
    -------------*/
    public function destroy($id) {

        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json([
            "data" => $task,
            "message" => 'El task fue eliminado correctamente'
        ], 200);

    }

}
