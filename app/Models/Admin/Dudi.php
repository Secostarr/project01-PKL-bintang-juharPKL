<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    use HasFactory;
    protected $table = 'migration_dudi';
    protected $primaryKey = 'id_dudi';

    protected $fillable = [
        'nama_dudi',
        'alamat',
    ];

    public function PembimbingDudi()
    {
        return $this->belongsTo(Pembimbing::class, 'id_dudi', 'id_dudi');   
    }
}
