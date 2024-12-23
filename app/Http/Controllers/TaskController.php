<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Récupérer toutes les tâches
    public function index()
    {
        try {
            $tasks = Task::all();
            return response()->json($tasks);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'priority' => 'required|integer|min:1|max:5',
                'due_date' => 'nullable|date',
                'is_important' => 'boolean',
            ]);
            
    
            // Convertir la date pour MySQL
            if ($request->has('due_date')) {
                $request->merge(['due_date' => date('Y-m-d', strtotime($request->due_date))]);
            }
    
            \Log::info('Données reçues pour création:', $request->all());
    
            $task = Task::create($request->all());
    
            return response()->json($task, 201);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création de la tâche:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    


    // Afficher une tâche spécifique
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
{
    try {
        // Règles de validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        // Vérifier si la tâche existe
        $task = Task::findOrFail($id);

        // Transformer la date si elle est fournie
        if ($request->has('due_date')) {
            $request->merge(['due_date' => date('Y-m-d', strtotime($request->due_date))]);
        }

        \Log::info('Mise à jour des données:', $request->all());

        // Mettre à jour la tâche
        $task->update($request->all());

        return response()->json($task, 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
    } catch (\Exception $e) {
        \Log::error('Erreur lors de la mise à jour de la tâche:', ['error' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    // Supprimer une tâche
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }

    public function markAsCompleted($id)
    {
        $task = Task::find($id);
        
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
    
        $task->status = 'completed';  
        $task->save();
    
        return response()->json($task, 200);
    }
    

}

