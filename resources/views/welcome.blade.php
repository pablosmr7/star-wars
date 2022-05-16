<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SW Database</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <!-- Derivados de JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-route.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    </head>


    <body>
        <div class="bgi">
        </div>

        <div class="nav-main" (scroll)="onscroll()"[ngClass]="navbarfixed?'fixed':'nofixed'">

            <h1 style="text-align:center;">
                <img src="{{ asset('img/1.png') }}" alt="image">
                    <a href="/starship/index" class="nav-data" > Star Wars Database </a>
                <img src="{{ asset('img/1.png') }}" alt="image">
            </h1>

            <div class="nav-data">	
                <h5>
                    <a href="/starship/index" >Naves Espaciales</a> / <a href="/starship/index">Personajes</a>
                </h5>
            </div>
            
        </div>

                <!--<hr>-->

            <main>
                <router-outlet></router-outlet>
            </main>
    
                <div class="banner">
                <h4>Gran Astillero de Coruscant</h4>
                <a routerLink="/starship/create" class="btn btn-success">Añadir Nave</a>
                </div>

                <br>
        <section>
        <div class="container" style="padding:20px;">


            @foreach ($data as $naves)

                <div class="data-card">

                    <div class="data-title">
                    <img src="../img/1.png" alt="image" class="icon">
                    <b>Nombre: </b><div>{{ $naves->name  }}</div><br>
                    </div>

                    <div class="data-content" id="test{{$naves->id}}">
                    <b>Identificacion: </b><div>{{ $naves->name  }}</div><br>
                    </div>

                    <div class="data-content">
                    <b>Coste: </b> <p class="credits{{$naves->id}}">{{ $naves->credits  }}</p>
                    </div>

                    <div class="data-content">
                    <b>Pilotos: </b>  <br>
                    </div>

                    <br><br>

                </div>

                

            @endforeach
        </div>


        </section>


        <script>
        $( document ).ready(function() {

            for(var i = 0; i < 40; i++){
                $('.credits'+i).text(convertBase({{ $naves->credits  }} ,10,15));

            //console.log( document.getElementsByClassName("credits"+i) );
            };

        //$('#credits').text(convertBase({{ $naves->credits  }},10,15));
        //console.log( document.getElementsByClassName("credits3").innerText );
         });
        </script>



        <script>
        //ESTE ES EL JS PARA CONVERTIR NUMEROS A BASE 15 Y VICEVERSA
        function convertBase(value, from_base, to_base) {
            var range = '0123456789\u00DF\u00DE\u00A2\u00B5\u00B6+/'.split('');
            var from_range = range.slice(0, from_base);
            var to_range = range.slice(0, to_base);

            value= value.toString();
            //value=document.getElemenByClassName("credits");
            
            var dec_value = value.split('').reverse().reduce(function (carry, digit, index) {
            if (from_range.indexOf(digit) === -1) throw new Error('Invalid digit `'+digit+'` for base '+from_base+'.');
            return carry += from_range.indexOf(digit) * (Math.pow(from_base, index));
            }, 0);
            
            var new_value = '';
            while (dec_value > 0) {
            new_value = to_range[dec_value % to_base] + new_value;
            dec_value = (dec_value - (dec_value % to_base)) / to_base;
            }
            //document.getElementByClassName("credits").innerHTML = new_value;
            return new_value || '0';
        }
        </script>













        <!-- BASURA DE ANGULAR -->


        


    <script>
        var app = angular.module("starwars", []);


        app.controller("Controlador", function($scope, $http){
            $scope.nombre = "CF";
            var data = $scope.data = {};

    data.options = [];

    var idrelacion = [];
            var conta = 0;
            var cuenta = -1;
            var conn=0;


            var url1 = "http://localhost:8000/api/starship/";
            var url2 = "http://localhost:8000/api/pilot";

            var urlPilotos = [];

            var xhr1 = null;
            var xhr2 = null;

            var datosTotal = null;
            var datosmi = null;
            var rat = null;
            var datosNaves = [];
            var datosPeople = [];
            var nombres = [];
            var pilotosna = [];
            var contarAux = [];
            var arrr = [];
            var contarBotones = 0;

            var contarPilotos = 0;

            var contador=0;

            

   


let dax = new Promise((resolve, reject) => {

    $http({
        method: 'GET',
        url: "http://localhost:8000/api/pilotShip"
    }).then(function successCallback(response) {
        datosmi=response;
        resolve();
    }, function errorCallback(response) {

    });
});

Promise.all([dax]).then();

            llamada(url1, url2);

            function llamada(url1, url2){

                if(url1!=null){
                    xhr1 = new Promise((resolve, reject) => {

                        $http({
                            method: 'GET',
                            url: url1
                        }).then(function successCallback(response) {
                            resolve(response);
                        }, function errorCallback(response) {

                        });

                    });
                }else{
                    xhr1 = null;
                }




                if(url2 != null){
                    xhr2 = new Promise((resolve, reject) => {
                        $http({
                            method: 'GET',
                            url: url2
                        }).then(function successCallback(response) {
                            data.options=response.data;
                            data.selected = data.options[0];
                            resolve(response);
                        }, function errorCallback(response) {

                        });
                    });
                }else{
                    xhr2 = null;
                }


                if(xhr1==null){
                    Promise.all([xhr1, xhr2]).then(successHandler, errorHandler);
                }else if(xhr2==null){
                    Promise.all([xhr1, xhr2]).then(successHandler, errorHandler);
                }else{
                    Promise.all([xhr1, xhr2]).then(successHandler, errorHandler);
                }
            }


        


            console.log(url1);
});


</script>


    </body>
</html>
