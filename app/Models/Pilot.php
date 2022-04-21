<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{

    protected $fillable=['name','url'];

//------------------------------------------------------------------------------------------------
    //pilotos no asignados
    public function unPilots(){
        $misPilotos=$this->pilots->pluck('pilots.id');

        $unPilots=Pilot::whereNotIn('id',$misPilotos)->get();
        return $unPilots;
    }









}
