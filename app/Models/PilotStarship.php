<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Pilot;

class PilotStarship extends Model
{
    protected $fillable=['id_pilot','id_starship'];

    public function getPilotbyId($idPilot){
        return Pilot::find($idPilot);
      } 
  
}
