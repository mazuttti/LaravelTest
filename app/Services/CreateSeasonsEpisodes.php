<?php

namespace App\Services;

use App\Models\Season;
use App\Models\Episode;

class CreateSeasonsEpisodes
{
    public function storeSeasonsEpisodes($anime_id, $season_number, $number_episodes)
    {
        $season = Season::create([
            'number' => $season_number,
            'anime_id' => $anime_id
        ]);

        for ($i = 1; $i <= $number_episodes; $i++) {
            $this->storeEpisodes($season->id, $i);
        
        }
    }

    public function storeEpisodes($season_id, $number)
    {
        Episode::create([
            'number' => $number,
            'season_id' => $season_id
        ]);
    }
}