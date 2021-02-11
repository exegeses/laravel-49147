# Eloquent ORM

   1. ¿qué es un ORM?
> ORM significa Object Relational Mapping
> Convierte una tabla en un objeto
> Es una clase, por lo tanto podrá tener: 
> propiedades y métodos

## Política de nombres

> Eloquent recomienda utilizar cierta política de nombres
> Model naming conventions

> Nombre de una tabla:
> table -> marcas
> Model -> Marca

    protected $table = 'regiones'

> Eloquent considera que TODAS las tablas 
> contienen dos campos de fecha
> created_at  y  updated_at

    public $timestaps = false;
