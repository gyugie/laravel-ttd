<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Recipe extends Model
{
    protected $fillable = ['title','procedure'];

    /**
     * publisher
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher(){
        return $this->belongsTo(User::class,'id');
    }

}
