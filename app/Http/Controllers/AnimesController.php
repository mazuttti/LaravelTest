<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Http\Requests\{AnimesFormRequest, UpdateAnimeFormRequest};
use App\Services\{CreateSeasons, DeleteAnime, StoreImg};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage};

class AnimesController extends Controller
{
    private function getAnimesList()
    {
        return DB::table('animes')
            ->join('seasons', 'seasons.anime_id', '=', 'animes.id')
            ->select('animes.id', 'animes.name', 'animes.img')
            ->groupBy('animes.id')
            ->orderBy('animes.updated_at', 'desc')
            ->get();
    }

    public function index()
    {
        return view('index', [
            'current_page' => 'index',
            'animes_list' => $this->getAnimesList()->take(10)
        ]);
    }

    public function showAnimes(Request $request)
    {
        $anime_list = $this->getAnimesList();
        
        $animes_without_season_list = DB::table('animes')
            ->leftJoin('seasons', 'seasons.anime_id', '=', 'animes.id')
            ->select('animes.id', 'animes.name', 'animes.img')
            ->where('seasons.number', '=', null)
            ->groupBy('animes.id')
            ->orderBy('animes.updated_at', 'desc')
            ->get();

        return view('admin/admin-animes', [
            'current_page' => 'admin',
            'animes_list' => $anime_list,
            'animes_without_season_list' => $animes_without_season_list,
            'message' => $request->session()->get('message')
        ]);
    }

    public function createAnime()
    {
        return view('admin/create-anime', ['current_page' => 'admin']);
    }

    public function storeCreateAnime(AnimesFormRequest $request)
    {
        $img = ($img = StoreImg::store($request)) ? $img : 'not-found.jpg';

        $anime = Anime::create([
            'name' => $request->name,
            'img' => $img
        ]);

        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', [
            'message' => $anime->name . ' foi adicionado com sucesso.',
            'alert' => 'success'
        ]); 

        return redirect()->route('seasons.create', [
            'id' => $anime->id,
            'seasons_number' => $request->seasons_number
        ]);
    }

    public function updateAnime(Request $request)
    {
        $message = $request->session()->get('message');

        $anime = Anime::find($request->id);

        $seasons_list = $anime->seasons;

        return view('admin/update-anime', [
            'current_page' => 'admin',
            'anime' => $anime,
            'seasons_list' => $seasons_list,
            'message' => $message
        ]);
    }

    public function storeUpdateAnime(int $id, UpdateAnimeFormRequest $request, CreateSeasons $create_seasons)
    {
        $id_of_another_anime = DB::table('animes')
            ->where('name', '=', $request->name)
            ->select('animes.id')
            ->first();

        $id_of_another_anime = isset($id_of_another_anime->id) ? $id_of_another_anime->id : null;

        if ($id_of_another_anime !== null and $id_of_another_anime !== $id) {
            /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
            $request->session()->flash('message', [
                'message' => $request->name . ' já possui cadastro no sistema.',
                'alert' => 'danger'
            ]);
            
            return redirect()->route('editar_anime', $id);
        }

        if ($img = StoreImg::store($request)) {
            DB::table('animes')
                ->where('id', $id)
                ->update([
                    'img' => $img,
                    'name' => $request->name,
                ]);
        
        } else {
            DB::table('animes')
                ->where('id', $id)
                ->update([
                    'name' => $request->name,
                ]);
        }

        if (intval($request->number_episodes) > 0 and intval($request->number_episodes) < 100) {
            $create_seasons->createOne($id, $request->number_episodes);

            DB::table('animes')
                ->where('id', $id)
                ->update([
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        }

        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', [
            'message' => $request->name . ' atualizado com sucesso.',
            'alert' => 'success'
        ]);
        
        return redirect()->route('editar_anime', $id);
    }

    public function deleteAnime(Request $request, DeleteAnime $delete_anime)
    {
        $anime = Anime::find($request->id);

        DB::beginTransaction();
        if ($anime->img !== 'not-found.jpg') {
            Storage::disk('public/img')->delete($anime->img);
            $anime->update(['img' => 'not-found.jpg']);
        }

        $response = $delete_anime->deleteAnime($anime);
        DB::commit();

        if ($response === true) {
            $message = $request->anime_name .' removido com sucesso';
            $alert = 'success';

        } else if ($response === false){
            $message = 'Erro ao tentar remover ' . $request->anime_name;
            $alert = 'danger';

        } else {
            $message = 'Erro inesperado';
            $alert = 'danger';

        }

        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', [
            'message' => $message,
            'alert' => $alert
        ]);

        return redirect()->route('admin_animes');
    }
}