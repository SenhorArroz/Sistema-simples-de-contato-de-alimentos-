<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use HasFactory;
    protected $table = 'mensagens';

    protected $fillable = [
        'id_usuario',
        'id_destinatario',
        'mensagem',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function destinatario()
    {
        return $this->belongsTo(User::class, 'id_destinatario');
    }
}
