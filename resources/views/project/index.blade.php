@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Projekty
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> Č. </th>
                                <th> Název </th>
                                <th> Odhadovaný čas </th>
                                <th> Odhadovaná cena</th>
                                <th> Od </th>
                                <th> Do </th>
                                <th> Status </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $i => $project)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->estimated_time }}</td>
                                    <td>{{ $project->estimated_price }}</td>
                                    <td>{{ $project->date_from }}</td>
                                    <td>{{ $project->date_to }}</td>
                                    <td>{{ $project->status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection