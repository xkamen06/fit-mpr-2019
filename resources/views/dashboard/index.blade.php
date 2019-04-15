@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            Přehled
                        </div>
                    </div>
                    <div class="panel-body">
                        <h2>Manažeři</h2>
                        <b>Celkem manažerů:</b> {{ $portfolioManagerUsersCount + $projectManagerUsersCount }}
                        <br>
                        <b>Porfolio manažerů:</b> {{ $portfolioManagerUsersCount }}
                        <br>
                        <b>Projektových manažerů:</b> {{ $projectManagerUsersCount }}
                        <br>
                        <hr>
                        <h2>Projekty</h2>
                        <b>Celkem projektů:</b> {{ $activeProjectCount + $doneProjectCount + $crisisManagementProjectCount}}
                        <br>
                        <b>Aktivních projektů:</b> {{ $activeProjectCount }}
                        <br>
                        <b>Hotových projektů:</b> {{ $doneProjectCount }}
                        <br>
                        <b>Projektů v krizovém řízení:</b> {{ $crisisManagementProjectCount }}
                        <br>
                        <hr>
                        <h2>Fáze</h2>
                        <b>Hotových fází:</b> {{ $donePhaseCount }}
                        <br>
                        <b>Fází "V řešení":</b> {{ $inProgressPhaseCount }}
                        <br>
                        <b>Nedokončených fází:</b> {{ $notDonePhaseCount }}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection