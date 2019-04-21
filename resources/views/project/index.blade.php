@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form {{-- class="form-inline" --}}>
                    
                    <div class="form-row">
                        <div class="col">
                            <label class="" for="project-manager">Projektový manažer</label>
                            <select class="custom-select" name="project_manager" id="project-manager">
                                <option value="-1">Nezvoleno</option>
                                @foreach($managers as $manager)
                                <option value="{{$manager->id}}" @if(array_key_exists('project_manager', $filters) && $filters['project_manager'] == $manager->id) selected="selected=" @endif >{{$manager->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label class="" for="actual-phase">Aktuální fáze</label>
                            <select class="custom-select" name="actual_phase" id="actual-phase">
                                <option value="-1">Nezvoleno</option>
                                @foreach($phases as $phase)
                                <option value="{{$phase->id}}" @if(array_key_exists('actual_phase', $filters) && $filters['actual_phase'] == $phase->id) selected="selected=" @endif >{{$phase->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label class="" for="project-name">Název projektu</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="project-name" name="project_name" placeholder="Název" @if(array_key_exists('project_name', $filters)) value="{{$filters['project_name']}}" @endif>
                            </div>
                        </div>

                        <div class="col">
                            <label class="" for="project-status">Status projektu</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input type="text" class="form-control" id="project-status" name="project_status" placeholder="Status" @if(array_key_exists('project_status', $filters)) value="{{$filters['project_status']}}" @endif>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2 float-right">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="btn btn-primary" href="{{ route('project.create') }}">
                            Přidat
                        </a>
                        <div class="text-center">
                            Projekty
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> Název </th>
                                <th> Projektový manažer</th>
                                <th> Nápad </th>
                                <th>Vytvořena Logická rámcová matice</th>
                                <th>Projekt byl schválen</th>
                                <th>Finanční prostředky a zdroje jsou uvolněny</th>
                                <th>Plánování</th>
                                <th>Návrh řešení</th>
                                <th>Řešení</th>
                                <th>Nasazení do provozu</th>
                                <th>Převzetí zákazníkem</th>
                                <th>Projekt je ukončen</th>
                                <th> Status </th>
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
                                    <td> <a href="{{ route('user.detail', ['userId' => $project->author->id]) }}">
                                            {{ $project->author->name }}
                                        </a>
                                    </td>
                                    @foreach($project->phases as $phase)
                                    <td>
                                        @if($phase->state === 'V řešení')
                                            V řešení
                                        @elseif($phase->state === 'Dokončený')
                                            Ano
                                        @else
                                            Ne
                                        @endif
                                    </td>
                                    @endforeach
                                    <td>{{ $project->status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $projects->appends($filters)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection