<?php

namespace App;
use App\Photo;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $primaryKey = 'id';
    protected $fillable=['name','cover_img'];
    public function photos(){
        return $this->hasMany(Photo::class);
    }
}
