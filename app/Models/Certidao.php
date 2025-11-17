<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certidao extends Model
{
    use HasFactory;
    protected $table = 'certidoes';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nome',
        'data_inclusao',
        'descricao',
        'palavras_chave',
        'arquivo_url',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'data_inclusao' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
