<?php

namespace App\Http\Controllers;

use App\Phase;
use App\Project;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class PhaseController
 * @package App\Http\Controllers
 */
class PhaseController extends Controller
{
    /**
     * Edit phase
     * @param int $phaseId
     * @return View
     */
    public function edit(int $phaseId): View
    {
        $users = User::all();
        $phase = Phase::find($phaseId);
        return view('phase.edit', compact('phase', 'users'));
    }

    /**
     * Update phase
     * @param int $phaseId
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $phaseId, Request $request): RedirectResponse
    {
        $phase = Phase::find($phaseId);
        $phase->id_user = $request->manager;
        $phase->price = $request->price;
        $phase->spent_time = $request->spent_time;
        $phase->date_from = $request->date_to;
        $phase->description = $request->description;
        $phase->save();
        return redirect()->route('project.detail', ['projectId' => $phase->id_project]);
    }

    /**
     * Change phase
     * @param int $projectId
     * @return View
     */
    public function changePhase(int $projectId): View
    {
        $project = Project::find($projectId);
        return view('phase.change', compact('project'));
    }

    /**
     *  Change - Update phase
     * @param int $projectId
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeUpdatePhase(int $projectId, Request $request): RedirectResponse
    {
        $project = Project::find($projectId);
        $phases = $project->phases;
        $actualPhaseId = (int) $request->phase;
        foreach ($phases as $phase) {
            if ($phase->phaseEnum->id < $actualPhaseId) {
                $phase->state = 'Dokončený';
            } else if ($phase->phaseEnum->id === $actualPhaseId) {
                $phase->state = 'V řešení';
            } else {
                $phase->state = 'Nedokončený';
            }
            $phase->save();
        }
        return redirect()->route('project.detail', ['projectId' => $projectId]);
    }

    /**
     * Index of phases
     * @param int $projectId
     * @return View
     */
    public function index(int $projectId): View
    {
        $project = Project::find($projectId);
        $phases = $project->phases;
        return view('phase.index', compact('phases'));
    }
}