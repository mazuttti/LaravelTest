@extends('layouts.main')

@section('title', 'AnimeLovers - Admin')

@section('content')
<div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteLabel">Confirmar ação</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <div type="text" class="form-control" id="recipient-name"></div>
            </div>
        </div>
        <div class="modal-footer">
            <form id="confirmationForm" method="post">
                @csrf
                <input type="hidden" class="form-control" name="anime_name" id="anime_name">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn-danger">Remover</button>
            </form>
        </div>
        </div>
    </div>
</div>

<div class="container my-3 app-container p-0">
    <div class="mx-3 py-3">
        <h3>Administração - Animes</h3>
        <a href="/admin/animes/criar" class="btn btn-primary mt-2">Adicionar</a>
    </div>

    @if(!empty($message))
    <div class="alert alert-{{ $message['alert'] }}">{{ $message['message'] }}</div>
    @endif

    <ul class="list-group">
        @foreach ($animes_list as $anime)
        <li class="d-flex align-items-center justify-content-between list-group-item">
            {{ $anime->name }}
            <div>
                <button type="button" class="btn btn-outline-danger" 
                    data-bs-toggle="modal" data-bs-target="#confirmDelete"
                    data-bs-whatever="{{ $anime->name }}"
                    id="{{ $anime->id }}"
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