<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} - @yield('title')</title>    
    <!-- Bootstrap CSS CDN -->
    <!-- Lien qui provient du site get bootstrap - Incule via CDN - 1er lien -->
    <!-- https://getbootstrap.com/ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid"> 
        @php $locale = session()->get('locale') @endphp
            <a class="navbar-brand" href="#">@lang('lang.text_hi') {{Auth::user() ? Auth::user()->name : 'Guest'}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <!-- guest = qui n'est pas connecté -->
                    @guest
                        <a class="nav-link" href="{{route('etudiant.create')}}">@lang('lang.text_students')</a>
                        <a class="nav-link" href="{{route('user.create')}}">@lang('lang.text_registration')</a>
                        <a class="nav-link" href="{{route('login')}}">@lang('lang.text_login')</a>
                    @else
                        <a class="nav-link" href="{{route('etudiant.index')}}">@lang('lang.text_students')</a>
                        <a class="nav-link" href="{{route('article.index')}}">Forum</a>
                        <a class="nav-link" href="{{route('file.index')}}">@lang('lang.text_files')</a>
                        <a class="nav-link" href="{{route('logout')}}">@lang('lang.text_logout')</a>
                    @endguest
                    <a class="nav-link @if($locale=='en') bg-secondary @endif" href="{{route('lang', 'en')}}">En</a>
                    <a class="nav-link @if($locale=='fr') bg-secondary @endif" href="{{route('lang', 'fr')}}">Fr</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- équivalent d'une page Master.blade.php -->
    <div class="container">
        <div class="row">
            <!-- pt=padding top -->
            <div class="col-12 pt-4">
                <!-- display-1 = format le plus grand et mt=margin top -->
                <h1 class="display-3 mt-5">
                    {{ config('app.name') }}
                </h1>
                <!-- message de succès pour un article effacée -->
                <!-- Provient de https://getbootstrap.com/docs/5.3/components/alerts/#examples section Dismissing -->
                <!-- Ce code ajoute de la couleur et un 'X' à la fin -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Va afficher toutes les erreurs -->
                @if(!$errors->isEmpty())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif           
            @yield('content')
            </div>
        </div>
    </div>
</body>
    <!-- Bootstrap CSS CDN -->
    <!-- Lien qui provient du site get bootstrap - Incule via CDN - 2e lien -->
    <!-- https://getbootstrap.com/ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>