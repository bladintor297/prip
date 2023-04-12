<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaModul extends Model
{
    use HasFactory;
    protected $table = 'peserta_modul';

    public $primaryKey = 'id';
    public $timestamps = true;
}
