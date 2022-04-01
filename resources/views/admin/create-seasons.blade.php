@extends('layouts.main')

@section('title', 'AnimeLovers - Adicionar Temporadas')

@section('content')
<div class="container my-3 app-container">
    <div class="mx-3 py-3">
        <h1 class="mb-4">Administração - Adicionar Temporadas</h1>

        @if (!empty($message))
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

        <form action="{{ route('salvar_temporadas', $anime_id) . '?seasons_number=' . $seasons_number }}" method="post">
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