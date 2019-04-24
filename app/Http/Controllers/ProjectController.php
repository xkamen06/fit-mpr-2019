<?php

namespace App\Http\Controllers;

use App\Phase;
use App\PhaseEnum;
use App\Project;
use App\User;
use App\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
    public function index(Request $request)
    {
        if (Auth::user()->role->name === 'admin' || Auth::user()->role->name === 'portfolio') {
            $projects = Project::orderBy('id', 'desc');
        } else {
            $phases = DB::table('phase')
                ->where('id_user', '=', Auth::id())
                ->get();
            $projIds = [];
            foreach ($phases as $phase) {
                $projIds[] = $phase->id_project;
            }
            
            $userId = Auth::id();
            $projects = Project::where(function($query) use ($userId, $projIds) {
                $query->whereIn('id', $projIds)
                    ->orderBy('id', 'desc')
                    ->orWhere('id_user', '=', Auth::id());
            });
        }

        $filters = [];
        if ($request->input('project_name') !== NULL) {
            $projects->where(function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->input('project_name') . '%');
            });
            $filters['project_name'] = $request->input('project_name');
        }

        if ($request->input('project_status') !== NULL) {
            $projects->where(function($query) use ($request) {
                $query->where('status', 'LIKE', '%' . $request->input('project_status') . '%');
            });
            $filters['project_status'] = $request->input('project_status');
        }

        if ($request->input('project_manager') !== NULL && $request->input('project_manager') != "-1") {
            $projects->where(function($query) use ($request) {
                $query->where('id_user', 'LIKE', '%' . $request->input('project_manager') . '%');
            });
            $filters['project_manager'] = $request->input('project_manager');
        }

        if ($request->input('actual_phase') !== NULL && $request->input('actual_phase') != "-1") {
            $projects->whereHas('actualPhase', function($query) use ($request) {
                $query->where('id_phase_enum', '=', $request->input('actual_phase'));
            });
            $filters['actual_phase'] = $request->input('actual_phase');
        }
        
//        $projects = $projects->paginate(15);
        $projects = $projects->get();
        $managers = User::get();
        $phases = PhaseEnum::get();
        
        return view('project.index', compact('projects', 'managers', 'filters', 'phases'));
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

        $uploadedFile = $request->file('file_attachment');
        $fileName = Str::random(40) . "___" . $uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->storeAs('phases_attachments', $fileName);

        $phaseFile = new File();
        $phaseFile->name = $uploadedFile->getClientOriginalName();
        $phaseFile->path = $filePath;

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

        $uploadedFile = $request->file('file_attachment');
        $fileName = Str::random(40) . "___" . $uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->storeAs('phases_attachments', $fileName);

        $phaseFile = new File();
        $phaseFile->name = $uploadedFile->getClientOriginalName();
        $phaseFile->path = $filePath;

        $project->actualPhase->files()->saveMany([$phaseFile]);

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
        return view('project.status.edit', compact('project'));
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
