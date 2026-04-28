<?php
namespace App\Models;

use CodeIgniter\Model;

class SharedMoviesModel extends Model
{
    protected $table = 'shared_movies';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'movie_id'];
    protected $useTimestamps = true;
}