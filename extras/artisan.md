# Comandos Artisan

## generar Model

    php artisan make:model Nombre  

> El nombre del Model, como es una clase, 
> debería ser en Mayúscula y en singular

    php artisan make:model Marca

> el model Marca se guarda en /app/Models

## generar un Controller

    php artisan make:controller NombreController

> El nombre del controller, como corresponde a un Model,
> debería ser el nobre del Model + Controller

    php artisan make:controller MarcaController

> Esto crea un controlador sin métodos.   
> Pero tambien podemos crear un controlador con métodos estándar   

    php artisan make:controller MarcaController -r   

