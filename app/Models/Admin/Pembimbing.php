<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{

    use HasFactory;
    protected $table = 'migration_pembimbing';
    protected $primaryKey = 'id_pembimbing';

    protected $fillable = [
        'id_guru',
        'id_dudi',
    ];

    public function guru()
    {
        return $this->hasOne(Guru::class, 'id_guru', 'id_guru');
    }

    public function dudi()
    {
        return $this->hasOne(Dudi::class, 'id_dudi', 'id_dudi');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_pembimbing', 'id_pembimbing');
    }
    
}
