<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    static public function storeEpisodes($season_id, $number)
    {
        Episode::create([
            'number' => $number,
            'season_id' => $season_id
        ]);
    }
}