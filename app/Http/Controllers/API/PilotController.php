<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Pilot;
use Log;

class PilotController extends Controller
{

    public function create(Request $request){
        $data['name'] = $request['name'];
        $data['birth_year'] = $request['birth_year'];
        $data['gender'] = $request['gender'];
        $data['species'] = $request['species'];
  
        Pilot::create($data);
        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
    }


    public function getPilot(){
        $data = Pilot::get();
        return response()->json($data, 200);
    }
  
      //MANDA UN JSON DE UNA UNICA NAVE DEL ID PROPORCIONADO
    public function get($id){
        $data = Pilot::find($id);
        return response()->json($data, 200);
    }


    public function update(Request $request,$id){
        $data['name'] = $request['name'];
        $data['birth_year'] = $request['birth_year'];
        $data['gender'] = $request['gender'];
        $data['species'] = $request['species'];
  
        Pilot::find($id)->update($data);
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }



    public function delete($id){
        $res = Pilot::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
    }
  
  
}
