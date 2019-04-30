@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projekty</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.detail', ['projectId' => $project->id]) }}">Projekt "{{ $project->name }}"</a></li>
                <li class="breadcrumb-item active" aria-current="page">Změnit aktuální fázi</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            Změnit aktuální fázi
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('phase.change.update', ['projectId' => $project->id])  }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="phase">Fáze</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="phase" id="phase" required>
                                        @foreach($project->phases as $phase)
                                            @if($phase->state === 'V řešení')
                                                <option value="{{ $phase->phaseEnum->id }}" selected>
                                                    {{ $phase->phaseEnum->name }}
                                                </option>
                                            @else
                                                <option value="{{ $phase->phaseEnum->id }}">
                                                    {{ $phase->phaseEnum->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" title="Upravit"
                                            class="btn btn-primary">
                                        Změnit
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