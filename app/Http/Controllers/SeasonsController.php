<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonsFormRequest;
use App\Models\Anime;
use App\Models\Season;
use App\Services\CreateSeasons;
use App\Services\DeleteAnime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeasonsController extends Controller
{
    public function create(Request $request)
    {
        return view('admin/create-seasons', [
            'current_page' => 'admin',
            'message' => $request->session()->get('message'),
            'anime_id' => $request->id,
            'seasons_number' => $request->seasons_number
        ]);
    }

    public function storeCreate(SeasonsFormRequest $request, CreateSeasons $seasons)
    {
        DB::beginTransaction();
        $seasons->create($request);
        DB::commit();
        
        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', [
            'message' => 'Temporadas e episódios criados com sucesso',
            'alert' => 'success'
        ]);

        return redirect()->route('admin_animes');
    }

    public function update()
    {
        return 'teste0';
    }

    public function storeUpdate()
    {
        return 'teste0';
    }

    public function delete(int $id, Request $request, DeleteAnime $delete_season)
    {
        $anime_id = Season::find($id)->anime_id;
        $last_season_id = Anime::find($anime_id)->seasons->max()->id;

        if ($last_season_id === $id) {
            DB::beginTransaction();
            $season = Season::find($id);
            $delete_season->deleteEpisodes($season);
            $season->delete();
            DB::commit();

            $message = 'Temporada removida com sucesso';
            $alert = 'success';
        
        } else {
            $message = 'Erro ao tentar remover temporada';
            $alert = 'danger';
        
        }

        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', [
            'message' => $message,
            'alert' => $alert
        ]);

        return redirect()->back();
    }
}