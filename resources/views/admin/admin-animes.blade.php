@extends('layouts.main')

@section('title', 'AnimeLovers - Admin')

@section('content')

@include('subviews.confirm-delete')

<div class="container my-3 app-container p-0">
    <div class="mx-3 py-3">
        <h3>Administração - Animes</h3>
        <a href="{{ route('criar_anime') }}" class="btn btn-primary mt-2">Adicionar</a>
    </div>

    @include('subviews.message', ['message' => $message])

    <ul class="list-group">
        @foreach ($animes_without_season_list as $anime)
        <li class="d-flex align-items-center justify-content-between list-group-item">
            <span class="app-text-danger">{{ $anime->name }} (Anime sem temporadas cadastradas)</span>

            @include('subviews.update-delete-btn', [
                'edit_link' => route('editar_anime',  $anime->id),
                'data' => $anime->name, 
                'id' => route('remover_anime',  $anime->id)
            ])
        </li>
        @endforeach

        @foreach ($animes_list as $anime)
        <li class="d-flex align-items-center justify-content-between list-group-item">
            {{ $anime->name }}

            @include('subviews.update-delete-btn', [
                'edit_link' => route('editar_anime',  $anime->id),
                'data' => $anime->name, 
                'id' => route('remover_anime',  $anime->id)
            ])
        </li>
        @endforeach
    </ul>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection