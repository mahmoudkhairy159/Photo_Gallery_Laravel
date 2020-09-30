<?php

namespace App;
use App\Photo;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $primaryKey = 'id';
    protected $fillable=['name','cover_img','user_id'];
    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
