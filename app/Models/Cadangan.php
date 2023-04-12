<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadangan extends Model
{
    use HasFactory;

    protected $table = 'cadangan';

    public $primaryKey = 'id';
    public $timestamps = true;

}
