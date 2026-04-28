<?php

namespace App\Controllers;



use App\Models\SharedMoviesModel;
use App\Models\MovieModel;
use App\Models\UserModel;

class SharedMoviesController extends BaseController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/sign-in')->with('error', 'You must be logged in to view shared movies.');
        }

        $sharedModel = new SharedMoviesModel();
        $movieModel  = new MovieModel();
        $userModel   = new UserModel();

        $sharedEntries = $sharedModel->findAll();

        $movies = [];
        foreach ($sharedEntries as $entry) {
            $movie = $movieModel->find($entry['movie_id']);
            $user  = $userModel->find($entry['user_id']);

            if ($movie && $user) {
                $movie['shared_by'] = explode('@', $user['email'])[0];
                $movies[] = $movie;
            }
        }

        return view('shared_movies', ['movies' => $movies]);
    }
}