<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //

    protected $table = 'countries';

    protected $fillable = ['country_code', 'country_name', 'currency_code', 'currency_name', 'phone_code', 'coins_code', 'continent_name'];
    
    public function user(){
        return $this->hasMany(User::class);
    }
}
