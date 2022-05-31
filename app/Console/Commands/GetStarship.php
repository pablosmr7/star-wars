<?php

namespace App\Console\Commands;

use App\Models\Pilot;
use App\Models\Starship;
use App\Models\PilotStarship;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GetStarship extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:starship';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para capturar naves desde SWAPI';





    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //RESETEO LA BASE DE DATOS CADA VEZ QUE SE LLAMA AL COMANDO
        Artisan::call('migrate:fresh');

        //PRIMERO LLAMO A LA API BASE CON GUZZLE PARA CAPTAR TODOS LOS DATOS
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://swapi.dev/api/',
            // You can set any number of default request options.
            'timeout'  => 0.0,
        ]);

    
        
        //CAPTACION DE PERSONAS CON GUZZLE
        for($x=1; $x<=9; $x++){         //HAY 9 PAGINAS DE PERSONAS  
            $response = $client->request('GET', 'people/?page='.$x.'&format=json');    
            $data2 = json_decode($response->getBody()->getContents());

            for($i=0; $i< sizeof($data2->results); $i++){
                $pilot = new Pilot();

                $pilot->delete();

                $pilot->name = $data2->results[$i]->name;
                $pilot->birth_year = $data2->results[$i]->birth_year;
                $pilot->gender = $data2->results[$i]->gender;


                $speciesaux=$data2->results[$i]->species;
                for($m=0; $m<sizeof($speciesaux); $m++){
                    $speciesraw = $speciesaux[$m];
                    $speciesref = substr($speciesraw, 30, -1);

                    $pilot->species = $speciesref;
                };
                                                                  
                $pilot->save();
            }
        }
//------------------------------------------------------------------------------------------------------------------

        //CAPTACION DE NAVES CON GUZZLE
            for($x=1; $x<=4; $x++){         //HAY 4 PAGINAS DE NAVES   
                $response = $client->request('GET', 'starships/?page='.$x.'&format=json');    
                $data = json_decode($response->getBody()->getContents());
                $page= $x;

                for($i=0; $i< sizeof($data->results); $i++){//ESTE FOR ES PARA LOS DATOS DE CADA PAGINA
                    $starship = new Starship();

                    $starship->delete();

                    $starship->name = $data->results[$i]->name;
                    $starship->model = $data->results[$i]->model;
                    $starship->manufacturer = $data->results[$i]->manufacturer;

                    if($data->results[$i]->cost_in_credits == 'unknown'){
                        $starship->credits = NULL;//ESTO ES UN PROBLEMON, COLEGA. Y SE VA A RESOLVER CON VARCHAR, YEAH BOII
                    }else{
                        $starship->credits = $data->results[$i]->cost_in_credits;
                    }

                    $starship->pilot =  $data->results[$i]->url;


                    //NAVES A PILOTOS
                    if($data->results[$i]->pilots == !null){
                        $pilotaux=$data->results[$i]->pilots;


                        for($z=0; $z<sizeof($pilotaux); $z++){ //ESTE FOR ES PARA CADA PILOTO QUE TENGA LA NAVE
                            $pilotShip = new PilotStarship();
                            
                            //CASTEO LOS DATOS PARA METERLOS EN LA TABLA pilot_statships
                            //LOS ARRAYS EMPIEZAN EN INDICE 0, LAS BD EN INDICE 1, COSAS QUE PASAN

                            if($page==1){
                                $shipId = $i+1;
                            }else if($page==2){
                                $shipId = $i+11;
                            }else if($page==3){
                                $shipId = $i+21;
                            }else if($page==4){
                                $shipId = $i+31;
                            }
                            
                            //RECORTO LOS DOS ULTIMOS CARACTERES DE LA URL DE PILOTOS PARA SACAR SU ID
                            //REFACTORIZADO, YA NO LO USO, PERO NO LE HACE DAÑO A NADIE
                            $pilotId = $pilotaux[$z];
                            $pilotId2 = substr($pilotId, 29, -1);
    
    
                            //ASIGNO Y GUARDO
                            $pilotShip->id_starship = $shipId;

                            if($pilotId2>15){
                                $pilotShip->id_pilot = $pilotId2-1;
                            }else{
                                $pilotShip->id_pilot = $pilotId2;
                            }

                        
                            $pilotShip->save();
                        }
                    }

                    //GUARDO LA NAVE SOLO CUANDO HE HECHO LA RELACION CON LOS PILOTOSO
                    $starship->save();
                    
                }


            }


    }



}
