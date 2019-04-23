@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">Nástěnka</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header">Manažeři</h5>
                                    <div class="card-body">
                                        <b>Celkem
                                            manažerů:</b> {{ $portfolioManagerUsersCount + $projectManagerUsersCount }}
                                        <br>
                                        <b>Porfolio manažerů:</b> {{ $portfolioManagerUsersCount }}
                                        <br>
                                        <b>Projektových manažerů:</b> {{ $projectManagerUsersCount }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header">Projekty</h5>
                                    <div class="card-body">
                                        <b>Celkem projektů:</b> {{ $activeProjectCount + $doneProjectCount + $crisisManagementProjectCount}}
                                        <br>
                                        <b>Aktivních projektů:</b> {{ $activeProjectCount }}
                                        <br>
                                        <b>Hotových projektů:</b> {{ $doneProjectCount }}
                                        <br>
                                        <b>Projektů v krizovém řízení:</b> {{ $crisisManagementProjectCount }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header">Fáze</h5>
                                    <div class="card-body">
                                        <b>Hotových fází:</b> {{ $donePhaseCount }}
                                        <br>
                                        <b>Fází "V řešení":</b> {{ $inProgressPhaseCount }}
                                        <br>
                                        <b>Nedokončených fází:</b> {{ $notDonePhaseCount }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection