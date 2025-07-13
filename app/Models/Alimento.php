<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
        'quantidade',
        'peso',
        'validade',
        'local',
        'tipo',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_produto', 'id');
    }

    public function doacoes()
    {
        return $this->hasMany(Doacao::class, 'alimento_id');
    }
}
