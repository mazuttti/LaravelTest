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

    private function setViewAndCurrentPage()
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
        
        }
    }

    public function create()
    {
        $this->setViewAndCurrentPage();

        return view($this->view, [
            'current_page' => $this->current_page
        ]);
    }

    public function store(AnimesFormRequest $request)
    {
        $name = $request->get('name');
        $img = '02.jpg';

        $anime = Anime::create([
            'name' => $name,
            'img' => $img
        ]);

        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', $anime->name . ' adicionado com sucesso.'); 

        return redirect('/admin/animes');
    }
    
    public function show(Request $request)
    {
        $animes_list = Anime::all();
        
        $this->setViewAndCurrentPage();

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
        
        $this->setViewAndCurrentPage();

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
        Anime::destroy($request->id);

        /** @var Illuminate\Http\Concerns\InteractsWithFlashData $request */
        $request->session()->flash('message', $request->anime_name . ' removido com sucesso');

        return redirect('/admin/animes');
    }
}