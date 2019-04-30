@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Projekty</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">Projekty</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-right mb-2">
                                <a class="btn btn-primary" href="{{ route('project.create') }}">
                                    Přidat projekt
                                </a>
                                <a class="btn btn-secondary" data-toggle="collapse" href="#filters"
                                   role="button" aria-expanded="false" aria-controls="filters">
                                    Zobrazit filtry
                                </a>
                            </div>
                        </div>
                        <div id="filters" class="collapse{{ $filters != null ? ' show' : '' }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-2 mt-2">
                                        <div class="card-body">
                                            <form {{-- class="form-inline" --}}>

                                                <div class="form-row">
                                                    <div class="col-2">
                                                        <label class="" for="project-manager">Projektový manažer</label>
                                                        <select class="custom-select" name="project_manager"
                                                                id="project-manager">
                                                            <option value="-1">Nezvoleno</option>
                                                            @foreach($managers as $manager)
                                                                <option value="{{$manager->id}}"
                                                                        @if(array_key_exists('project_manager', $filters) && $filters['project_manager'] == $manager->id) selected="selected=" @endif >{{$manager->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-3">
                                                        <label class="" for="actual-phase">Aktuální fáze</label>
                                                        <select class="custom-select" name="actual_phase"
                                                                id="actual-phase">
                                                            <option value="-1">Nezvoleno</option>
                                                            @foreach($phases as $phase)
                                                                <option value="{{$phase->id}}"
                                                                        @if(array_key_exists('actual_phase', $filters) && $filters['actual_phase'] == $phase->id) selected="selected=" @endif >{{$phase->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-3">
                                                        <label class="" for="project-name">Název projektu</label>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input type="text" class="form-control" id="project-name"
                                                                   name="project_name" placeholder="Název"
                                                                   @if(array_key_exists('project_name', $filters)) value="{{$filters['project_name']}}" @endif>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <label class="" for="project-status">Status projektu</label>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input type="text" class="form-control" id="project-status"
                                                                   name="project_status" placeholder="Status"
                                                                   @if(array_key_exists('project_status', $filters)) value="{{$filters['project_status']}}" @endif>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <label class="invisible">Akce</label>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <button type="submit" class="btn btn-primary form-control">
                                                                Vyfiltrovat
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Název</th>
                                <th>Projektový manažer</th>
                                <th style="width: 70%;">Fáze projektu</th>
                                <th>Status</th>
                                <th>Od</th>
                                <th>Do</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $i => $project)
                                <tr>
                                    <td>
                                        <a href="{{ route('project.detail', ['projectId' => $project->id]) }}">
                                            {{ $project->name }}
                                        </a>
                                    </td>
                                    <td><a href="{{ route('user.detail', ['userId' => $project->author->id]) }}">
                                            {{ $project->author->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="progress" title="{{$project->actualPhase ? $project->actualPhase->phaseEnum->id : 11}}">
                                            @foreach($project->phases as $phase)
                                                <div class="progress-bar border-right {{ $phase->state === 'V řešení' ? 'bg-primary' : ($phase->state === 'Nedokončený' ? 'bg-dark' : 'bg-success') }}"
                                                     style="width: 10%"
                                                     data-toggle="tooltip"
                                                     data-placement="bottom"
                                                     title="{{ $phase->phaseEnum->name }} - {{ $phase->state }}">
                                                    {{ $phase->phaseEnum->getShortName($phase->phaseEnum->id) }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>{{ $project->status }}</td>
                                    <td>
                                        <small>{{ $project->date_from }}</small>
                                    </td>
                                    <td>
                                        <small>{{ $project->date_to }}</small>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#example').DataTable( {
                "columnDefs": [
                    {
                        "targets": [ 2 ],
                        "searchable": false,
                        "type": "title-numeric",
                    }
                ],
                "language": {
                    "aria": {
                        "sortAscending": ": klikněte k řazení sloupce vzestupně",
                        "sortDescending": ": klikněte k řazení sloupce sestupně"
                    },
                    "emptyTable": "Žádné data k dispozici :(",
                    "info": "Zobrazuji _START_ až _END_ záznamů z celkového počtu _TOTAL_",
                    "infoEmpty": "Žádné záznamy k zobrazení",
                    "infoFiltered": "",
                    "lengthMenu": "Počet záznamů na stránku:  _MENU_ ",
                    "search": "Vyhledat:",
                    "zeroRecords": "Pro hledaný výraz nebyly nalezeny žádné záznamy",
                },
            });
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection