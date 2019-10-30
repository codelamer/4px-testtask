<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSection extends Model
{
    protected $table = 'section_user';


    /**
     * Return users for current section
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
//    public function users()
//    {
//        return $this->belongsToMany(User::class);
//    }
}
