<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LivewireController extends Controller
{
    public function index()
    {
        $postId = \request('postId',1);
        $response = Http::get('https://jsonplaceholder.typicode.com/comments?postId='.$postId);
        return view('livewire')
            ->with([
                'comments' => collect($response->json())
            ]);
    }
}
