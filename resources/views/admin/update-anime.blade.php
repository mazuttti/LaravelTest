@extends('layouts.main')

@section('title', 'AnimeLovers - Editar Anime')

@section('content')
<div class="container my-3 app-container p-0">
    <div class="mx-3 py-3">
        <h3>Administração - Editar Animes</h3>
        <form action="{{ route('salvar_anime') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Anime</label>
                <input type="text" name="name" id="name" class="form-control" 
                    placeholder="Shingeki no Kyojin" required>     
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Imagem do Anime</label>
                <input type="file" name="img" id="img" class="form-control">     
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
        </li>
        @endforeach
    </ul>
</div>
@endsection