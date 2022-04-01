<?php

namespace App\Services;

use App\Models\Episode;
use App\Models\Season;

class DeleteAnime
{
    public function deleteAnime($anime): bool
    {
        $this->deleteSeasons($anime);
        
        return $anime->delete();
    }
    
    private function deleteSeasons($anime)
    {
        $anime->seasons->each( function (Season $season){
            $this->deleteEpisodes($season);
            $season->delete();
        });
    }

    private function deleteEpisodes($season)
    {
        $season->episodes->each( function (Episode $episode){
            $episode->delete();
        });
    }
}