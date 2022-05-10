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
    

    public function getAll(){
      $data = Starship::get();
      $data2 = Pilot::get();
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



    public function create(Request $request){
      $data['name'] = $request['name'];
      $data['credits'] = $request['credits'];
      //$data['phone'] = $request['phone'];
      Starship::create($data);
      return response()->json([
          'message' => "Successfully created",
          'success' => true
      ], 200);
    }


    public function delete($id){
      $res = Starship::find($id)->delete();
      return response()->json([
          'message' => "Successfully deleted",
          'success' => true
      ], 200);
    }


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
