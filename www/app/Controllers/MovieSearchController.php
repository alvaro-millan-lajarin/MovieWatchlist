<?php

namespace App\Controllers;

class MovieSearchController extends BaseController
{
    public function index()
    {

        if (!session()->has('user_email')) {
            return redirect()->to('/sign-in')->with('error', 'You must be logged in to access the movies page.');
        }

        $query = $this->request->getGet('query');
        $movies = [];

        if ($query) {
            $apiKey = 'd923abfce5a9b88e7f6b9b295aafcf38';

            $url = "https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&query=" . urlencode($query);

            $response = @file_get_contents($url);

            if ($response !== false) {
                $data = json_decode($response, true);

                if (isset($data['results'])) {
                    foreach ($data['results'] as $movie) {

                        $movies[] = [
                            'title' => $movie['title'],
                            'year' => isset($movie['release_date']) ? substr($movie['release_date'], 0, 4) : 'N/A',
                            'poster' => $movie['poster_path'] ? "https://image.tmdb.org/t/p/w500" . $movie['poster_path'] : '',
                            'plot' => $movie['overview'] ?? 'No description available',
                            'id' => $movie['id']
                        ];
                    }
                }
            }
        }

        return view('moviesSearch', [
            'movies' => $movies,
            'query' => $query
        ]);
    }
}