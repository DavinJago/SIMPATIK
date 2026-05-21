<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model {
    protected $fillable = ['nama', 'nim', 'kelas', 'mata_kuliah', 'hari', 'jam_mulai', 'jam_selesai'];
}