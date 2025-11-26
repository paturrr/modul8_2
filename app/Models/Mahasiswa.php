<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model ini.
     * Secara default, Laravel akan menggunakan bentuk plural dari nama model (mahasiswas).
     *
     * @var string
     */
    protected $table = 'mahasiswas';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Ini melindungi dari kerentanan mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nim',
        'prodi',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     * Ini mencakup implementasi casting datetime yang Anda berikan.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}