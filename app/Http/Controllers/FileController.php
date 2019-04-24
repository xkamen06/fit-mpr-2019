<?php

namespace App\Http\Controllers;

use App\File;
use App\Project;
use App\Phase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Phase $phase)
    {
        $project = $phase->project;

        return view('phase.file.create', compact('project', 'phase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Phase $phase)
    {
        $project = $phase->project;

        $uploadedFile = $request->file('file_attachment');
        
        if ($uploadedFile) {
            $fileName = Str::random(40) . "___" . $uploadedFile->getClientOriginalName();
            $filePath = $uploadedFile->storeAs('phases_attachments', $fileName);
            $phaseFile = new File();
            $phaseFile->name = $uploadedFile->getClientOriginalName();
            $phaseFile->path = $filePath;

            $phase->files()->saveMany([$phaseFile]);
        }

        return redirect()->route('project.detail', ['projectId' => $project->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return $file->download();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        Storage::delete($file->path);
        $file->delete();
        return back();
    }
}
