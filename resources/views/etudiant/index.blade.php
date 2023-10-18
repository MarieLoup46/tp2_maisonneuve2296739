@extends('layouts.app')

@section('title', 'Liste des étudiants')

@section('content')
    <hr>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>@lang('lang.text_list_students')</h2>
                    <div class="col-md-12">
                        <a href="{{ route('etudiant.create') }}" class="btn btn-primary">@lang('lang.text_add')</a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($etudiants as $etudiant)
                            <li class="list-group-item"><a href="{{route('etudiant.show', $etudiant->id)}}">{{ $etudiant->nom }}</a></li>
                        @empty
                            <li class='text-danger'>@lang('lang.text_no_students').</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection