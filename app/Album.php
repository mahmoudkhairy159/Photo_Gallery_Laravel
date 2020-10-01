<?php

namespace App;
use App\Photo;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Album extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable=['name','cover_img','user_id'];
    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
