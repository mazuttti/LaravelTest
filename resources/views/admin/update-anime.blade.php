@extends('layouts.main')

@section('title', 'AnimeLovers - Editar Anime')

@section('content')
<div class="container my-3 app-container p-0">
    <div class="mx-3 py-3">
        <h3>Administração - Editar Animes</h3>

        @if(!empty($message))
        <div class="alert alert-{{ $message['alert'] }}">{{ $message['message'] }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('salvar_anime_editado', $anime->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Anime</label>
                <input type="text" name="name" id="name" class="form-control" 
                    placeholder="Shingeki no Kyojin" value="{{ $anime->name }}" pattern="[\w\s]{2,255}" required>     
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Imagem do Anime</label>
                <input type="file" name="img" id="img" class="form-control">     
            </div>

            <div class="mb-3">
                <label for="new_season" class="form-label">Adicionar nova Temporada:</label>
                <input type="text" name="new_season" id="new_season" class="form-control" 
                        placeholder="1-99" pattern="[1-9][0-9]?">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

    <ul class="list-group">
        @foreach ($seasons_list as $season)
        <li class="d-flex align-items-center justify-content-between list-group-item">
            Temporada {{ $season->number }}

            <div>
                <a href="{{ route('editar_anime',  $season->id) }}" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete"
                    data-bs-whatever="{{ $season->number }}" id="{{ route('remover_anime',  $season->id) }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                    </svg>
                </button>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection