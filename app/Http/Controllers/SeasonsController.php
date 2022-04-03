<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonsFormRequest;
use App\Services\CreateSeasons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeasonsController extends Controller
{
    public function createSeasons(Request $request)
    {
        return view('admin/create-seasons', [
            'current_page' => 'admin',
            'message' => $request->session()->get('message'),
            'anime_id' => $request->id,
            'seasons_number' => $request->seasons_number
        ]);
    }

    public function storeSeasons(SeasonsFormRequest $request, CreateSeasons $seasons)
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
}