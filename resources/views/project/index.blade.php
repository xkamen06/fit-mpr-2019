@extends('layouts.app')

@section('content')
    <div class="container">
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
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection