@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projekty</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.detail', ['projectId' => $project->id]) }}">Projekt "{{ $project->name }}"</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Fáze {{$phase->phaseEnum->name}}</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">
                            Přidat nový soubor k fázi
                        </h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('file.save', ['phase' => $phase->id])  }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="file_attachment">Příloha</label>
                                <div class="col-sm-8">
                                    <input name="file_attachment" id="file_attachment" type="file">
                                </div>
                                <br>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" title="Vytořit"
                                            class="btn btn-primary">
                                        Vložit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection