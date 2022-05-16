<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Starship;
Use App\Models\PilotStarship;
Use App\Models\Pilot;
Use Log;

class StarshipController extends Controller
{
    
    //ESTE METODO LLEVA A LA PAGINA INICIAL
    public function getAll(){
      $data = Starship::get();
      $data2 = Pilot::get();
      return view('welcome')->with(['data'=>$data, 'data2'=>$data2]); 
      //return response()->json($data, 200);
    }

////////////ESTOS METODOS DEVUELVEN JSONS DE NUESTRA BD
    public function getShip(){
      $data = Starship::get();
      return response()->json($data, 200);
    }

    public function getPilotShip(){
      $data = PilotStarship::get();
      return response()->json($data, 200);
    }

    public function getPilot(){
      $data = Pilot::get();
      return response()->json($data, 200);
    }

/////////////////////////////////////////////////////////////
//ESTOS METODOS CREAN TARJETA Y PILOTO ASOCIADO A NAVE///////
/////////////////////////////////////////////////////////////

    public function create(Request $request){
      $data['name'] = $request['name'];
      $data['credits'] = $request['credits'];

      Starship::create($data);
      return response()->json([
          'message' => "Successfully created",
          'success' => true
      ], 200);
    }



    public function createPilotShip(Request $request){
      $data['id_pilot'] = $request['id_pilot'];
      $data['id_starship'] = $request['id_starship'];

      PilotStarship::create($data);
      return response()->json([
          'message' => "Successfully created",
          'success' => true
      ], 200);
    }

/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////
//ESTOS METODOS BORRAN TARJETA Y PILOTO ASOCIADO A NAVE//////
/////////////////////////////////////////////////////////////

    public function delete($id){
      $res = Starship::find($id)->delete();
      return response()->json([
          'message' => "Successfully deleted",
          'success' => true
      ], 200);
    }

    public function deletePilotShip($id){
      $res = PilotStarship::find($id)->delete();
      return response()->json([
          'message' => "Successfully deleted",
          'success' => true
      ], 200);
    }

/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////

    public function get($id){
      $data = Starship::find($id);
      return response()->json($data, 200);
    }


    public function update(Request $request,$id){
      $data['name'] = $request['name'];
      $data['credits'] = $request['credits'];
      //$data['phone'] = $request['phone'];
      Starship::find($id)->update($data);
      return response()->json([
          'message' => "Successfully updated",
          'success' => true
      ], 200);
    }
    
}
