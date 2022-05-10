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
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="jquery-1.3.2.min.js" type="text/javascript"></script>   

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



        <div class="container" style="padding:20px;">

            <!--<hr>-->

        <main>
            <router-outlet></router-outlet>
        </main>
        </div>


        <section class="banner">
  
            <div class="">
            <h4>Gran Astillero de Coruscant</h4>
            <a routerLink="/starship/create" class="btn btn-success">Añadir Nave</a>
            </div>

            <br>



        <div class="data-card" *ngFor="let starship of starships">

            <div class="data-title">
            <img src="../img/1.png" alt="image" class="icon">
            <b>Nombre: </b> <br>
            </div>

            <div class="data-content">
            <b>Identificacion: </b> <br>
            </div>

            <div class="data-content">
            <b>Coste: </b>
            </div>

            <div class="data-content">
            <b>Pilotos: </b>  <br>
            </div>

            <br><br>
            
            <div class="data-options">
            <a href="#" [routerLink]="['/starship/', 'edit', starship.id  ]" class="btn btn-primary">Edit</a>
            <button type="button" (click)="deleteStarship(starship.id)" class="btn btn-danger">Delete</button>
            </div>

        </div>

        </section>

    </body>
</html>
