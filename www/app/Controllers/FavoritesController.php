<?php

namespace App\Controllers;

use App\Models\FavoriteModel;
use App\Models\MovieModel;

class FavoritesController extends BaseController
{
    public function index()
    {

        if (!session()->has('user_id')) {
            return redirect()->to('/sign-in')
                ->with('error', 'You must be logged in to access your favorites.');
        }

        $userId = session()->get('user_id');

        $favoriteModel = new FavoriteModel();
        $movieModel    = new MovieModel();


        $favorites = $favoriteModel->where('user_id', $userId)->findAll();

        $movies = [];
        foreach ($favorites as $fav) {
            $movie = $movieModel->find($fav['movie_id']);
            if ($movie) {
                $movies[] = $movie;
            }
        }

        return view('favorites', ['movies' => $movies]);
    }
}