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

  // ESTE METODO LLEVA A LA PAGINA INICIAL
  // ESTE METODO HA SIDO ABANDONADO, SINCERAMENTE, NO SE HACER ANGULARJS EN UN
  //  PROYETO LARAVEL


    /*
    public function getAll(){
      $data = Starship::get();
      $data2 = Pilot::get();
      return view('welcome')->with(['data'=>$data, 'data2'=>$data2]); 
      //return response()->json($data, 200);
    }*/


/////////////////////////////////////////////////////////////////////////////////////////
////////////////////ESTOS METODOS DEVUELVEN JSONS DE NUESTRA BD//////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


    //MANDA UN JSON DE TODAS LAS NAVES
    public function getShip(){
      $data = Starship::get();
      return response()->json($data, 200);
    }


    //MANDA UN JSON DE LOS PILOTOS ASOCIADOS AL ID DE UNA NAVE
    public function getShipPilots($id){
      //error_log("Hello");
      $data = PilotStarship::where(["id_starship"=>$id])->get();
      //error_log(count($data));
      foreach( $data as $pilotShip){
        //error_log($pilotShip->id_pilot);
        $pilotShip->pilot=$pilotShip->getPilotbyId($pilotShip->id_pilot);

      }
      return response()->json($data, 200);
    }


    //MANDA UN JSON CON LA RELACION DE PILOTOS Y NAVES
    public function getPilotShip(){
      $data = PilotStarship::get();
      return response()->json($data, 200);
    }


    //MANDA UN JSON DE TODOS LOS PILOTOS
    public function getPilot(){
      $data = Pilot::get();
      return response()->json($data, 200);
    }

    //MANDA UN JSON DE UNA UNICA NAVE DEL ID PROPORCIONADO
    public function get($id){
      $data = Starship::find($id);
      return response()->json($data, 200);
    }

/////////////////////////////////////////////////////////////
////ESTOS METODOS GUARDAN NAVES Y RELACIONES PILOTOS-NAVE////
/////////////////////////////////////////////////////////////


    //RECIBE DATOS Y CREA UNA NUEVA NAVE CON ESOS DATOS
    public function create(Request $request){
      $data['name'] = $request['name'];
      $data['credits'] = $request['credits'];

      Starship::create($data);
      return response()->json([
          'message' => "Successfully created",
          'success' => true
      ], 200);
    }


    //RECIBE DATOS Y HACE UNA RELACION DE PILOTO-NAVE
    public function createPilotShip(Request $request){
      $data['id_pilot'] = $request['id_pilot'];
      $data['id_starship'] = $request['id_starship'];

      PilotStarship::create($data);
      return response()->json([
          'message' => "Successfully created",
          'success' => true
      ], 200);
    }



////////////////////////////////////////////////////////////////
//////ESTOS METODOS BORRAN NAVE Y PILOTO ASOCIADO A NAVE////////
////////////////////////////////////////////////////////////////


    //BORRA NAVE DEL ID PROPORCIONADO
    public function delete($id){
      $res = Starship::find($id)->delete();
      return response()->json([
          'message' => "Successfully deleted",
          'success' => true
      ], 200);
    }


    //BORRA UNA RELACIÓN DE PILOTO CON NAVE
    public function deletePilotShip($id){
      $res = PilotStarship::find($id)->delete();
      return response()->json([
          'message' => "Successfully deleted",
          'success' => true
      ], 200);
    }

/////////////////////////////////////////////////////////////////
///////ESTOS METODOS ACTUALIZAN INFORMACIÓN DE LA DATBASE////////
/////////////////////////////////////////////////////////////////

    //RECIBE Y ACTUALIZA LOS DATOS DE LA NAVE CON EL ID ASOCIADO
    public function update(Request $request,$id){
      $data['name'] = $request['name'];
      $data['credits'] = $request['credits'];

      Starship::find($id)->update($data);
      return response()->json([
          'message' => "Successfully updated",
          'success' => true
      ], 200);
    }
    
}
