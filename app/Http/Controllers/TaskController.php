<?php

namespace App\Http\Controllers;

// use Charts;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use App\Models\User;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Facades\Charts;
use DB;
use App\Chart;

use Illuminate\Database\Eloquent\Builder;


class TaskController extends Controller
{
    //Dashoard 
    public function view () {
        $events = array();
        $tasks = Task::with('status')->get();
        $color = null;
        foreach($tasks as $task){
            if($task->status['name'] == 'Income'){
                $color = '#3cb371';
            }else if($task->status['name'] == 'Expenditure'){
                $color = '#ff0000';
            }
            $events[] = [
                'id' => $task->id,
                'title' => $task->title,
                'start' => $task->start_date,
                'end' => $task->due_date,
                'description' => $task->description,
                'status' => $task->status_id,
                'color' => $color
            ];
        }
        return view('dashboard', compact('events'));
    }

    //View Task History
    public function history()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->with('status')->orderBy('created_at', 'desc')->paginate(9);
        return view('history', compact('tasks'));
    }

    //Add Task
    public function addTask(Request $request)
    {
            $request->validate([
                'title'=>'required|string|min:2',
                'description' => 'required',
                'type' => 'required',
                'amount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            
            $task = new Task;

            $task->title = $request->title;
            $task->description = $request->description;
            $task->start_date = $request->start_date;
            $task->status_id = $request->type;
            $task->amount = $request->amount;
            $task->user_id = Auth::user()->id;
    
            $task->save();
    
            return response()->json($task);
    }

    public function updateTask(Request $request, $id)
    {

        $task = Task::find($id);
        if(!$task){
            return response()->json(['error' => 'not updated']);
        }

        $task->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return response()->json(['success' => 'Task updated']);

    }

    public function stat($type)
    {
        $userid = Auth::user()->id;
        $tasks = Task::where('user_id', $userid)->get();
        $totalIncome = 0;
        $totalExpenses = 0;
        foreach($tasks as $task){
            if($task->status_id === 1){
                $totalIncome += $task['amount'];    
            }else{
                $totalExpenses += $task['amount'];
            }
            
        }
        $income = Task::where('status_id', 2)->where('user_id', $userid)->get();     
        $percentage = number_format(($totalExpenses / $totalIncome) * 100, 2);

        return view('stat', compact('tasks', 'totalIncome', 'percentage', 'totalExpenses'));
    }


    public function destroy($id)
    {
        $task =  Task::findOrFail($id);
        $task->delete();
        return $id;
    }

    public function budget()
    {
        return view('budget');
    }

    public function budgetapi($mon, $year){
        // try{
            $tasks = Task::whereYear('start_date', $year)->whereMonth('start_date', $mon)->get();
            $budget = Budget::where('month', $mon)->get();
            dd($budget);
            return response()->json($budget);
        // }catch (Exception $e)
        // {
        //     return response()->json($e->getMessage());
        // }

    }
}
