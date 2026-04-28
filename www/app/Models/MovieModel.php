<?php
namespace App\Models;
use CodeIgniter\Model;

class MovieModel extends Model {
    protected $table = 'movies';
    protected $primaryKey = 'id';
    protected $allowedFields = ['api_id','title','year','poster','introduction'];
    protected $useTimestamps = true;
}