<?php

namespace App\Services;

use App\Models\Anime;
use Illuminate\Support\Facades\Storage;

class StoreImg
{
    static public function store($request)
    {
        if ($request->hasFile('img') and $request->file('img')->isValid()) {
            $old_img = Anime::find($request->id);

            if (isset($old_img) and $old_img->img !== 'not-found.jpg') {
                Storage::disk('public/img')->delete($old_img->img);
            }

            $request_img = $request->img;

            $img_name = md5($request_img->getClientOriginalName() . strtotime("now")) . "." . $request_img->extension();

            $request_img->move(public_path('img/animes'), $img_name);

            return $img_name;
        }

        return false;
    }
}