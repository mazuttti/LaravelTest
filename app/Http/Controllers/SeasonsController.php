<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    static public function storeSeasons($anime_id, $season_number, $number_episodes, EpisodesController $episodes)
    {
        $season = Season::create([
            'number' => $season_number,
            'anime_id' => $anime_id
        ]);

        for ($i = 1; $i <= $number_episodes; $i++) {
            $episodes->storeEpisodes($season->id, $i);
        
        }
    }
}