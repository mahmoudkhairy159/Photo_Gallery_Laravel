<?php

namespace App;
use App\Album;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Photo extends Model
{
    use SoftDeletes;
    protected $fillable=['title','photo','album_id'];

    public function album(){
        return $this->belongsTo(Album::class);
    }
}
