@extends('layouts.main')

@section('title', 'AnimeLovers')

@section('content')
<div class="d-flex align-items-center justify-content-center mt-3">
    <hr class="app-index-hr col-sm-3 col-md-4">
    <p class="col-12 col-sm-4 col-md-3 col-lg-2 app-index-p my-0 mx-2">Lançamentos</p>
    <hr class="app-index-hr col-sm-3 col-md-4">
</div>
<section class="container-fluid">
    <div class="row justify-content-center p-3 p-sm-0">
        @foreach ($animes_list as $anime)
        <figure class="col-12 col-sm-5 col-md-3 col-lg-2 card app-card p-0 m-2">
            <a href="">
                <img src="{{ asset('img/animes/' . $anime->img) }}" class="card-img-top app-card" alt="Imagem do Anime">
                <div class="d-flex align-items-center justify-content-center container-fluid position-absolute app-anime-name px-2 py-1">
                    <p class="card-text">{{ $anime->name }}</p>
                </div>
            </a>
        </figure>
        @endforeach
    </div>
</section>
@endsection
