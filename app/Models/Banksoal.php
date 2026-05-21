<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banksoal extends Model {
    protected $fillable = ['judul', 'jumlah_soal', 'praktikum', 'mata_kuliah'];
}