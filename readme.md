Esta app laravel funciona como backend del proyecto STAR WARS DATABASE.

Hace uso de un recurso online llamado SWAPI para captar datos mediante json y guardarlos en base de datos.
Este proceso se hace automaticamente ustilizando el metodo "php artisan get:starship"

Se ha intentado realizar un front para este mismo proyecto añadiendo AngularJS en el propio index.blade.php, pero esa idea
ha sido abandonada en pos de la funcionalidad, modularidad, y escalabilidad sencilla de la aplicación.

El frontend de la pagina se ha realizado en un proyecto ANGULAR separado, que recoge los datos de esta API, y les da funcionalidad
y visibilidad. 

El repositorio del frontend para esta aplicación se encuentra aquí:
https://github.com/pablosmr7/star-frontend
