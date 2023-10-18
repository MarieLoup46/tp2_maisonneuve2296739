@extends('layouts.app')

@section('title', 'Article')

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('article.index') }}" class="btn btn-outline-primary btn-sm">@lang('lang.text_return')</a>
            <h4 class="display-4 mt-5 fw-medium">
                {{ $article->title }}
            </h4>
            <hr>
            <p>
                <span class="fs-4 fw-normal">{{ $article->content }}</span>
            </p>
            <p>
                <!-- la fonction 'articleEtudiant' est déclaré dans le model Article -->
                <span class="text-primary">@lang('lang.text_author') : </span> {{ $article->articleEtudiant->nom }}
            </p>
            <p>
                <span class="text-primary">Date : </span> {{ $article->date }}
            </p>
        </div>
    </div>

    <hr>
    @if($article->etudiant_id === $user->id)
        <div class="row mb-5">
            <div class="col-6">
                <a href="{{ route('article.edit', $article->id) }}" class="btn btn-primary">@lang('lang.text_update')</a>
            </div>
            <div class="col-6">
                <!-- Provient de https://getbootstrap.com/docs/5.3/components/modal/ -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">@lang('lang.text_delete')</button>
            </div>
        </div>
        <!-- Provient de https://getbootstrap.com/docs/5.3/components/modal/ -->
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('lang.text_delete')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                @lang('lang.text_delete_message_article') {{ $article->title }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.text_close')</button>
                    <form action="{{ route('article.delete', $article->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="@lang('lang.text_delete')" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
