@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('project.index') }}">Projekty</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('project.detail', ['projectId' => $project->id]) }}">Projekt "{{ $project->name }}"</a></li>
                <li class="breadcrumb-item active" aria-current="page">Změnit status</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            Upravit status projektu
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('project.status.update', ['projectId' => $project->id])  }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="status">Status</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="status" id="status" required>
                                        @if($project->status === 'Aktivní')
                                            <option value="Aktivní" selected>Aktivní</option>
                                            <option value="Dokončený">Dokončený</option>
                                            <option value="Krizové řízení">Krizové řízení</option>
                                        @elseif($project->status === 'Dokončený')
                                            <option value="Aktivní">Aktivní</option>
                                            <option value="Dokončený" selected>Dokončený</option>
                                            <option value="Krizové řízení">Krizové řízení</option>
                                        @elseif($project->status === 'Krizové řízení')
                                            <option value="Aktivní">Aktivní</option>
                                            <option value="Dokončený">Dokončený</option>
                                            <option value="Krizové řízení" selected>Krizové řízení</option>
                                        @endif
                                    </select>
                                </div>
                                <br>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" title="Změnit"
                                            class="btn btn-primary">
                                        Vytvořit
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