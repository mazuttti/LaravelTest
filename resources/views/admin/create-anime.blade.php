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

        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Anime</label>
                <input type="text" name="name" id="name" class="form-control" 
                    placeholder="Shingeki no Kyojin" required>     
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </form>
    </div>
</div>
@endsection