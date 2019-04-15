<?php

namespace App\Http\Controllers;

use App\Phase;
use App\Project;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * Show all projects paginator
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'portfolio') {
            $projects = Project::orderBy('id', 'desc')
                ->paginate(15);
        } else {
            $phases = DB::table('phase')
                ->where('id_user', '=', Auth::id())
                ->get();
            $projIds = [];
            foreach ($phases as $phase) {
                $projIds[] = $phase->id_project;
            }
            $projects = Project::whereIn('id', $projIds)
                ->orderBy('id', 'desc')
                ->orWhere('id_user', '=', Auth::id())
                ->paginate(15);
        }
        return view('project.index', compact('projects'));
    }

    /**
     * Show project detail
     * @param int $projectId
     * @return View
     */
    public function detail(int $projectId) : View
    {
        $project = Project::find($projectId);
        return view('project.detail', compact('project'));
    }

    /**
     * Create project
     * @return View
     */
    public function create() : View
    {
        $users = User::all();
        return view('project.create', compact('users'));
    }

    /**
     * Store project
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $project = new Project();
        $project->name = $request->name;
        $project->id_user = $request->manager;
        $project->estimated_time = $request->estimated_time;
        $project->estimated_price = $request->estimated_price;
        $project->date_from = $request->date_from;
        $project->date_to = $request->date_to;
        $project->status = 'Aktivní';
        $project->save();
        for ($i = 1; $i <= 10; $i++) {
            $phase = new Phase();
            $phase->id_project = $project->id;
            $phase->id_user = $request->manager;
            $phase->id_phase_enum = $i;
            $phase->price = 0;
            $phase->spent_time = 0;
            $phase->date_from = date('Y-m-d');
            $phase->date_to = date('Y-m-d');
            if ($i === 1) {
                $phase->state = 'V řešení';
            } else {
                $phase->state = 'Nedokončený';
            }
            $phase->save();
        }
        return redirect()->route('project.detail', ['projectId' => $project->id]);
    }

    /**
     * Edit project
     * @param int $projectId
     * @return View
     */
    public function edit(int $projectId): View
    {
        $users = User::all();
        $project = Project::find($projectId);
        return view('project.edit', compact('project', 'users'));
    }

    /**
     * Update project
     * @param int $projectId
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $projectId, Request $request): RedirectResponse
    {
        $project = Project::find($projectId);
        $project->name = $request->name;
        $project->id_user = $request->manager;
        $project->estimated_time = $request->estimated_time;
        $project->estimated_price = $request->estimated_price;
        $project->date_from = $request->date_from;
        $project->date_to = $request->date_to;
        $project->save();
        return redirect()->route('project.detail', ['projectId' => $project->id]);
    }

    /**
     * Edit project status
     * @param int $projectId
     * @return View
     */
    public function editStatus(int $projectId): View
    {
        $project = Project::find($projectId);
        $status = $project->status;
        return view('project.status.edit', compact('projectId', 'status'));
    }

    /**
     * Update project status
     * @param int $projectId
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateStatus(int $projectId, Request $request): RedirectResponse
    {
        $project = Project::find($projectId);
        $oldStatus = $project->status;
        $phases = $project->phases;
        if ($request->status === 'Dokončený') {
            foreach ($phases as $phase) {
                $phase->state = 'Dokončený';
                $phase->save();
            }
        } else if ($oldStatus === 'Dokončený') {
            foreach ($phases as $i => $phase) {
                if ($i === 0) {
                    $phase->state = 'V řešení';
                } else {
                    $phase->state = 'Nedokončený';
                }
                $phase->save();
            }
        }
        $project->status = $request->status;
        $project->save();
        return redirect()->route('project.detail', ['projectId' => $project->id]);
    }
}
