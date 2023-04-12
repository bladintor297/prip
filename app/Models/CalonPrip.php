<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonPrip extends Model
{
    use HasFactory;
    protected $table = 'calon_prip';

    public $primaryKey = 'id';
    public $timestamps = true;
}
