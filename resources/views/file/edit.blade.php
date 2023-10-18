@extends('layouts.app')
@section('title', 'Mettre à jour')

@section('content')
<div class="row">
        <div class="col-12 text-center pt-2">
            <h1 class="display-one">@lang('lang.text_update')</h1>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                @method('put')
                @csrf
                    <div class="card-header text-primary">
                        @lang('lang.text_form')
                    </div>
                    <div class="card-body">   
                        <div class="control-grup col-12 mb-3">
                            <label class="fw-bold" for="title_fr">@lang('lang.text_title_fr')</label>
                            <input type="text" id="title_fr" name="title_fr" class="form-control" value="{{ $file->title_fr }}">
                        </div>
                        <div class="control-grup col-12 mb-3">
                            <label class="fw-bold" for="title">@lang('lang.text_title_en')</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ $file->title }}">
                        </div>
                        <div class="control-grup col-12 mb-3">
                            <label class="fw-bold" for="title">@lang('lang.text_file')</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="control-grup col-12 mb-3">
                            <label class="fw-bold" for="date">Date</label>
                            <input type="text" id="date" name="date" placeholder="YYYY-MM-DD" class="form-control"  value="{{ $file->date }}">
                        </div>
                    </div>
                    <div class="card-footer mb-3 text-center">
                        <input type="submit" class="btn btn-success" value="@lang('lang.text_update')">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
