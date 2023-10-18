@extends('layouts.app')

@section('title', 'Liste des fichiers')

@section('content')
    <hr>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>@lang('lang.text_file_list')</h2>
                    <div class="col-md-12">
                        <a href="{{ route('file.create') }}" class="btn btn-primary">@lang('lang.text_add')</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr class=" table-info">
                                <th>@lang('lang.text_file')</th>
                                <th>@lang('lang.text_name')</th>
                                <th>@lang('lang.text_file_download')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($count > 0)
                                @for($i=0; $i < $count; $i++)
                                    <tr>
                                        <td><a href="{{route('file.show', $files[$i]->id)}}">{{ $files[$i]->title }}</a></td>
                                        <td>{{ $files2[$i]->fileEtudiant->nom  }}</td>
                                        <td><form action="{{route('down')}}" method="post"><input type="submit" class="btn btn-warning" value="@lang('lang.text_download')"></form></td>
                                    </tr>
                                @endfor
                            @else
                                <tr>
                                    <td  colspan="2" class='text-danger'>@lang('lang.text_no_files').</td>
                                <tr>
                            @endif                   
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $files->links() }}
        </div>
    </div>
@endsection
