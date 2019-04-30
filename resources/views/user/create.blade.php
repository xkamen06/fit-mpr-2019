@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Uživatelé</a></li>
                <li class="breadcrumb-item active" aria-current="page">Přidat uživatele</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center mb-4">
                            Přidat uživatele
                        </h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('user.save')  }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Jméno</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="name" id="name" type="text">
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="email">Email</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="email" id="email" type="email">
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="password">Heslo</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="password" id="password" type="password">
                                </div>
                                <br>
                                <label class="control-label col-sm-2" for="role">Role</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="role" id="role">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">
                                                @if($role->name === 'portfolio_manager')
                                                    Portfolio manažer
                                                @elseif($role->name === 'project_manager')
                                                    Projekt manažer
                                                @else
                                                    Administrátor
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" title="Vytvořit"
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