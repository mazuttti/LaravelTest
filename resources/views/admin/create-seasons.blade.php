@extends('layouts.main')

@section('title', 'AnimeLovers - Adicionar Temporadas')

@section('content')
<div class="container my-3 app-container">
    <div class="mx-3 py-3">
        <h1 class="mb-4">Administração - Adicionar Temporadas</h1>

        @include('subviews.message', ['message' => $message])

        @include('subviews.errors', ['errors' => $errors])

        <form action="{{ route('seasons.store', $anime_id) . '?seasons_number=' . $seasons_number }}" method="post">
            @csrf
            <div class="row mb-3">
                @for ($i = 1; $i <= $seasons_number; $i++)
                <div class="col-3">
                    <label for="season_{{$i}}" class="form-label">Nº Episódios da Temporada {{ $i }}:</label>
                    <input type="text" name="number_episodes_{{$i}}" id="season_{{$i}}" class="form-control" 
                        placeholder="1-99 Episódios" pattern="[1-9][0-9]?" required>
                </div>
                @endfor
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection