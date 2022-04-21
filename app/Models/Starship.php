<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Starship extends Model
{
    protected $fillable=['name','credits', 'pilot', 'img'];
    protected $casts =[
        'pilot' => 'array'
    ];


    public function pilots(){

        return $this->belongsToMany('App\Models\pilot')->withTimestamps();
    }

//--------------------------------------PARA AJAX-------------------------------------------
    //pilotos no asignados
    public function unPilots(){
        $misPilotos=$this->pilots->pluck('pilots.id');

        $unPilots=Pilot::whereNotIn('id',$misPilotos)->get();
        return $unPilots;
    }






}
