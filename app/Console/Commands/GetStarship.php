<?php

namespace App\Console\Commands;

use App\Models\Pilot;
use App\Models\Starship;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

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

                $pilot->name = $data2->results[$i]->name;
                $pilot->url = $data2->results[$i]->url; //Cuidado, esto va a dar problemas
                                                                    //Necesidad guardar tambien naves????

                $pilot->save();
                }
            }
//------------------------------------------------------------------------------------------------------------------

        //CAPTACION DE NAVES CON GUZZLE
            for($x=1; $x<=4; $x++){         //HAY 4 PAGINAS DE NAVES   
                $response = $client->request('GET', 'starships/?page='.$x.'&format=json');    
                $data = json_decode($response->getBody()->getContents());

                for($i=0; $i< sizeof($data->results); $i++){
                    $starship = new Starship();

                    $starship->name = $data->results[$i]->name;
                    $starship->credits = $data->results[$i]->cost_in_credits;  //ESTO ES UN PROBLEMON, COLEGA. Y SE VA A RESOLVER CON VARCHAR, YEAH BOII
                    $starship->pilot = $data->results[$i]->pilots; //OJO OJITO OJETE QUE ESTO ES UN ARRAY!!!!

                    $starship->save();
                }
            }





    }
}
