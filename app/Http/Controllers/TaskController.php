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
        $tasks = Task::with('statuses')->orderBy('created_at', 'asc')->get();
        return view('dashboard');
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
        try
        {
            $request->validate([
                'title'=>'required|string|min:2',
                'description' => 'required',
                'start_date' => 'required',
            ]);
    
            $task = new Task;
    
            $task->title = $request->title;
            $task->description = $request->description;
            $task->start_date = $request->start_date;
            $task->status_id = 1;
            $task->user_id = Auth::user()->id;
    
            $task->save();
    
            return back()->with('success', 'Added Successfully');
        }
        catch(\Exception $e)
        {
            return back()->with('failed', $e->getMessage()); 
        }

    }

    public function stat($type)
    {
        // Get users grouped by age
        $groups = DB::table('tasks')
        ->select('status_id', DB::raw('count(*) as total'))
        ->groupBy('status_id')
        ->pluck('total', 'status_id')->all();
        // Generate random colours for the groups
        for ($i=0; $i<=count($groups); $i++) {
        $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        // Prepare the data for returning with the view
        $chart = new Chart;
        $chart->labels = (array_keys($groups));
        $chart->dataset = (array_values($groups));
        $chart->colours = $colours;
        return view('charts.index', compact('chart'));
    }
}
