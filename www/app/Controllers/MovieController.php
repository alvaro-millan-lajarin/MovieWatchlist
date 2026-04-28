<?php

namespace App\Controllers;

use App\Models\MovieModel;
use App\Models\CommentModel;
use App\Models\FavoriteModel;
use App\Models\SharedMoviesModel;
use App\Models\UserModel;

class MovieController extends BaseController
{
    public function details($idPeli)
    {

        if (!session()->has('user_id')) {
            return redirect()->to('/sign-in')
                ->with('error', 'You must be logged in to access the movie details page.');
        }


        $apiKey = 'd923abfce5a9b88e7f6b9b295aafcf38';

        $url = "https://api.themoviedb.org/3/movie/$idPeli?api_key={$apiKey}";
        $response = file_get_contents($url);
        $movieData = json_decode($response, true);

        $urlCredits = "https://api.themoviedb.org/3/movie/$idPeli/credits?api_key={$apiKey}";
        $responseCredits = file_get_contents($urlCredits);
        $creditsData = json_decode($responseCredits, true);


        $director = null;
        if (isset($creditsData['crew']) && is_array($creditsData['crew'])) {
            foreach ($creditsData['crew'] as $crew) {
                if ($crew['job'] === 'Director') {
                    $director = $crew['name'];
                    break;
                }
            }
        }

        $actors = [];
        if (isset($creditsData['cast']) && is_array($creditsData['cast'])) {
            foreach (array_slice($creditsData['cast'], 0, 5) as $cast) {
                $actors[] = $cast['name'];
            }
        }

        $genreNames = [];
        if (isset($movieData['genres']) && is_array($movieData['genres'])) {
            foreach ($movieData['genres'] as $g) {
                if (isset($g['name'])) $genreNames[] = $g['name'];
            }
        }
        $genresString = implode(', ', $genreNames);

        $movieModel = new MovieModel();
        $movie = $movieModel->where('api_id', $idPeli)->first();
        if (!$movie) {
            $movieModel->insert([
                'api_id' => $idPeli,
                'title' => $movieData['title'],
                'year' => substr($movieData['release_date'], 0, 4),
                'poster' => $movieData['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movieData['poster_path'] : null,
                'introduction' => $movieData['overview'],

            ]);
            $movie = $movieModel->where('api_id', $idPeli)->first();
        }


        $commentModel = new CommentModel();
        $comments = $commentModel->where('movie_id', $movie['id'])->findAll();


        $favModel = new FavoriteModel();
        $isFavorite = $favModel->where([
            'user_id' => session()->get('user_id'),
            'movie_id' => $movie['id']
        ])->first() ? true : false;


        $sharedModel = new SharedMoviesModel();
        $isShared = $sharedModel->where([
            'user_id' => session()->get('user_id'),
            'movie_id' => $movie['id']
        ])->first() ? true : false;


        return view('movie_details', [
            'movie' => $movieData,
            'movieDB' => $movie,
            'comments' => $comments,
            'isFavorite' => $isFavorite,
            'isShared' => $isShared,
            'director' => $director,
            'actors' => $actors,
            'genres' => $genresString
        ]);
    }


    public function addComment($apiId)
    {
        $movieModel = new MovieModel();
        $movie = $movieModel->where('api_id', $apiId)->first();

        if (!$movie) return redirect()->back();

        $commentModel = new CommentModel();
        $commentModel->insert([
            'movie_id' => $movie['id'],
            'user_id' => session()->get('user_id'),
            'comment' => $this->request->getPost('comment')
        ]);

        return redirect()->back();
    }

    public function toggleFavorite()
    {
        $movieId = $this->request->getPost('movie_id');
        $userId = session()->get('user_id');

        $model = new FavoriteModel();
        $exists = $model->where(['user_id'=>$userId,'movie_id'=>$movieId])->first();

        if ($exists) $model->delete($exists['id']);
        else $model->insert(['user_id'=>$userId,'movie_id'=>$movieId]);

        return redirect()->back();
    }


    public function shareMovie()
    {
        $movieId = $this->request->getPost('movie_id');
        $userId = session()->get('user_id');

        $model = new SharedMoviesModel();
        $exists = $model->where(['user_id'=>$userId,'movie_id'=>$movieId])->first();

        if (!$exists) $model->insert(['user_id'=>$userId,'movie_id'=>$movieId]);

        return redirect()->back();
    }
}