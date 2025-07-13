<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_doador_id',
        'user_receptor_id',
        'alimento_id',
        'quantidade',
    ];

    public function doador()
    {
        return $this->belongsTo(User::class, 'user_doador_id');
    }

    public function receptor()
    {
        return $this->belongsTo(User::class, 'user_receptor_id');
    }

    public function alimento()
    {
        return $this->belongsTo(Alimento::class, 'alimento_id');
    }
}
