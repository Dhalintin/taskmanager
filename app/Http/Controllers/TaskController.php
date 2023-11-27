<?php

namespace App\Http\Controllers;

// use Charts;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Facades\Charts;
use DB;
use App\Chart;


class TaskController extends Controller
{
    //Dashoard 
    public function view () {
        $events = array();
        $tasks = Task::with('status')->get();
        $color = null;
        foreach($tasks as $task){
            if($task->status['name'] == 'Completed'){
                $color = '#3cb371';
            }else{
                $color = null;
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
        $tasks = Task::where('user_id', Auth::user()->id)->with('statuses')->orderBy('created_at', 'desc')->get();
        return view('history', compact('tasks'));
    }

    //Add Task
    public function addTask(Request $request)
    {
            $request->validate([
                'title'=>'required|string|min:2',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            
            $task = new Task;

            $task->title = $request->title;
            $task->description = $request->description;
            $task->start_date = $request->start_date;
            $task->status_id = 1;
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

    // public function stat($type)
    // {
    //     // Get users grouped by age
    //     $groups = DB::table('tasks')
    //     ->select('status_id', DB::raw('count(*) as total'))
    //     ->groupBy('status_id')
    //     ->pluck('total', 'status_id')->all();
    //     // Generate random colours for the groups
    //     for ($i=0; $i<=count($groups); $i++) {
    //     $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
    //     }
    //     // Prepare the data for returning with the view
    //     $chart = new Chart;
    //     $chart->labels = (array_keys($groups));
    //     $chart->dataset = (array_values($groups));
    //     $chart->colours = $colours;
    //     return view('charts.index', compact('chart'));
    // }


    public function destroy($id)
    {
        $task =  Task::findOrFail($id);
        $task->delete();
        return $id;
    }
}
