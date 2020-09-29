<?php

namespace App;
use App\Album;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable=['title','photo','album_id'];

    public function album(){
        return $this->belongsTo(Album::class);
    }
}
