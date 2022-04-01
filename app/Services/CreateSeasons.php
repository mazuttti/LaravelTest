<?php

namespace App\Services;

use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;

class CreateSeasons
{
    public function create($request){
        for ($i = 1; $i <= $request->seasons_number; $i++) {
            $number_episodes = 'number_episodes_' . $i;
            $this->storeSeasons($request->id, $i, $request->$number_episodes);
        }
    }

    public function createOne($anime_id, $number_episodes)
    {
        $last_season = DB::table('seasons')
                ->where('anime_id', $anime_id)
                ->max('number');

        $i = $last_season + 1;

        $this->storeSeasons($anime_id, $i, $number_episodes);
    }
    
    private function storeSeasons($anime_id, $season_number, $number_episodes)
    {
        
        $season = Season::create([
            'number' => $season_number,
            'anime_id' => $anime_id
        ]);

        for ($i = 1; $i <= $number_episodes; $i++) {
            $this->storeEpisodes($season->id, $i);
        
        }
    }

    private function storeEpisodes($season_id, $number)
    {
        Episode::create([
            'number' => $number,
            'season_id' => $season_id
        ]);
    }
}