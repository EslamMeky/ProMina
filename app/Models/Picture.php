<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $table='pictures';
    protected $fillable=[
        'id',
        'name_photo',
        'Pathphoto',
        'album_id',
        'created_at',
        'updated_at'
    ];
    public function ScopeSelection($query)
    {
        return $query->select([
            'id',
            'name_photo',
            'Pathphoto',
            'album_id',
            'created_at',
            'updated_at'

        ]);
    }
    protected $timestamp = true;

    public function getPathphotoAttribute($val)
    {
        return ($val!=null)? asset('assets/'.$val):"";
    }

    public function albums(){
        return $this->belongsTo(Album::class,'album_id','id');
    }

}
