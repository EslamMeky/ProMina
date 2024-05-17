<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table='albums';
    protected $fillable=[
        'id',
        'name',
        'desc',
        'image',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function ScopeSelection($query)
    {
        return $query->select([
            'id',
            'name',
            'desc',
            'image',
            'user_id',
            'created_at',
            'updated_at'

        ]);
    }
    protected $timestamp = true;

    public function getImageAttribute($val)
    {
        return ($val!=null)? asset('assets/'.$val):"";
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function photos(){
        return $this->belongsTo(Picture::class,'album_id','id');
    }


}
