@extends('layouts.app')

@section('title', 'Liste des articles')

@section('content')
    <hr>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>@lang('lang.text_list_articles')</h2>
                    <div class="col-md-12">
                        <a href="{{ route('article.create') }}" class="btn btn-primary">@lang('lang.text_add')</a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($articles as $article)
                            <li class="list-group-item"><a href="{{route('article.show', $article->id)}}">{{ $article->title }}</a></li>
                        @empty
                            <li class='text-danger'>@lang('lang.text_no_articles').</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection