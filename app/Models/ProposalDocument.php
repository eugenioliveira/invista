<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalDocument extends Model
{
    use HasFactory;

    /**
     * Desabilita a proteção contra mass assignment
     * uma vez que os campos serão validados.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Assim que a referência de um documento for excluído da base de dados, garante que
     * o mesmo também seja excluído do disco
     */
    protected static function booted()
    {
        static::deleting(function ($document) {
            \Storage::disk('documents')->delete($document->filename);
        });
    }
}
