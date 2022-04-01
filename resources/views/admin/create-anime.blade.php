@extends('layouts.main')

@section('title', 'AnimeLovers - Adicionar Anime')

@section('content')
<div class="container my-3 app-container">
    <div class="mx-3 py-3">
        <h1 class="mb-4">Administração - Adicionar Anime</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('salvar_anime') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Anime</label>
                <input type="text" name="name" id="name" class="form-control" 
                    placeholder="Ex: Shingeki no Kyojin (Deve ser unico)" pattern="[\w\s]{2,255}" required>     
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Imagem do Anime</label>
                <input type="file" name="img" id="img" class="form-control">     
            </div>

            <div class="mb-3">
                <label for="seasons_number" class="form-label">Nº de Temporadas</label>
                <input type="text" name="seasons_number" id="seasons_number" class="form-control" 
                    placeholder="1-99" pattern="[1-9][0-9]?" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </form>
    </div>
</div>
@endsection