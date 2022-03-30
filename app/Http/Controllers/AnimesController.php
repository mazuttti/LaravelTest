<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Http\Requests\AnimesFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimesController extends Controller
{
    private string $view;
    private string $current_page;

    private function verifyURL()
    {
        $url = str_replace(url(''), '', url()->current());

        if ($url === '') {
            $this->current_page = 'index';
            $this->view = 'index';
        
        } else if ($url === '/admin/animes') {
            $this->current_page = 'admin';
            $this->view = 'admin/admin-anime';
        
        } else if ($url === '/admin/animes/criar') {
            $this->current_page = 'admin';
            $this->view = 'admin/create-anime';
        
        } else if (
            str_contains($url, '/admin/animes/criar/temporadas/') and 
            is_numeric($season_number = substr($url, 31)) and $season_number > 0
        ) {
            $this->current_page = 'admin';
            $this->view = 'admin/create-seasons-episodes';
 
        } else {
            $this->view = 'errors/404';
        
        }
    }

    public function create()
    {
        $this->verifyURL();

        return view($this->view, [
            'current_page' => $this->current_page
        ]);
    }

    public function createSeasons(Request $request)
    {
        $this->verifyURL();

        if ($this->view === 'errors/404') {
            return view($this->view);
        }

        echo $request->id;

        return view($this->view, [
            'current_page' => $this->current_page
        ]);
    }

    public function store(AnimesFormRequest $request)
    {
        $name = $request->get('name');

        if ($request->hasFile('img') and $request->file('img')->isValid()) {
            $request_img = $request->img;

            $ext = $request_img->extension();

            $img_name = md5($request_img->getClientOriginalName() . strtotime("now")) . "." . $ext;

            $request_img->move(public_path('img/animes'), $img_name);

            $img = $img_name;

        } else {
            $img = 'not-found.jpg';

        }

        $anime = Anime::create([
            'name' => $name,
            'img' => $img
        ]);

        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', [
            'message' => $anime->name . ' adicionado com sucesso.',
            'alert' => 'success'
        ]); 

        return redirect()->route('criar_temporadas', [
            'id' => $anime->id,
            'n_temporadas' => $request->seasons_number
        ]);
    }
    
    public function show(Request $request)
    {
        $animes_list = Anime::all();
        
        $this->verifyURL();

        $message = $request->session()->get('message');

        return view($this->view, [
            'current_page' => $this->current_page,
            'animes_list' => $animes_list,
            'message' => $message
        ]);
    }

    public function index()
    {
        $animes_list = DB::table('animes')->orderBy('created_at', 'desc')->get()->take(12);
        
        $this->verifyURL();

        return view($this->view, [
            'current_page' => $this->current_page,
            'animes_list' => $animes_list
        ]);
    }

    public function update()
    {
        //
    }

    public function delete(Request $request)
    {
        $response = Anime::destroy($request->id);

        if ($response === 1) {
            $message = $request->anime_name .' removido com sucesso';
            $alert = 'success';

        } else if ($response === 0){
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

        return redirect('/admin/animes');
    }
}