@extends('layouts.main')

@section('title', 'AnimeLovers - Editar Anime')

@section('content')

@include('subviews.confirm-delete')

<div class="container my-3 app-container p-0">
    <div class="mx-3 py-3">
        <h3>Administração - Editar Animes</h3>

        @include('subviews.message', ['message' => $message])

        @include('subviews.errors', ['errors' => $errors])

        <form action="{{ route('salvar_anime_editado', $anime->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Anime</label>
                <input type="text" name="name" id="name" class="form-control" 
                    placeholder="Ex: Shingeki no Kyojin (Deve ser unico)" value="{{ $anime->name }}" pattern="[\w\s]{2,255}" required>     
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Imagem do Anime</label>
                <input type="file" name="img" id="img" class="form-control">     
            </div>

            <div class="mb-3">
                <label for="number_episodes" class="form-label">Adicionar nova Temporada:</label>
                <input type="text" name="number_episodes" id="number_episodes" class="form-control" 
                        placeholder="1-99 Episódios" pattern="[1-9][0-9]?">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

    <ul class="list-group">
        @php
            $last_season = $seasons_list->last();
        @endphp

        @foreach ($seasons_list as $season)
        <li class="d-flex align-items-center justify-content-between list-group-item">
            {{ $season->number }}ª Temporada ({{ $season->episodes->count() }} episódios)

            @include('subviews.update-delete-btn', [
                'edit_link' => route('seasons.update',  $season->id),
                'data' => $season->number . 'ª Temporada', 
                'id' => route('seasons.delete',  $season->id),
                'is_it_the_last_season' => $season == $last_season ? true : false
            ])
        </li>
        @endforeach
    </ul>
</div>
@endsection

@section('project.js')
    <script src="{{ asset('js/project.js') }}"></script>
@endsection