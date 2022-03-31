<?php

namespace App\Services;

use App\Models\Episode;
use App\Models\Season;

class DeleteSeasonsEpisodes
{
    public function deleteSeasonsEpisodes($anime): bool
    {
        $anime->seasons->each( function (Season $season){
            $this->deleteEpisodes($season);
        });

        return $anime->delete();
    }

    public function deleteEpisodes($season)
    {
        $season->episodes->each( function (Episode $episode){
            $episode->delete();
        });
        
        $season->delete();
    }
}