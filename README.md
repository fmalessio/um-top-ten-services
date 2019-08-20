# Proyecto

Api Rest para recuperar un TopTen, guardar uno nuevo, o Resetear el TopTen.
Tecnologías: PHP y MySQL.

### Endpoints

API Resources, Request & Response.

  - [GET /api/top-ten/read.php](#get-read)
  - [POST /api/top-ten/save.php](#post-save)
  - [PUT /api/top-ten/reset.php](#put-reset)

### GET /api/top-ten/read.php

El objetivo es poder recuperar el Top Ten.

Ejemplo:
- Request:
	
```json
	/api/top-ten/read.php
```

- Response:

```json
{
    "score": [
        {
            "id": "6",
            "name": "Juana de Arco",
            "attempts": "2",
            "date": "2018-08-11"
        },
        {
            "id": "7",
            "name": "Pedro",
            "attempts": "3",
            "date": "2018-08-11"
        },
        {
            "id": "10",
            "name": "Amaia",
            "attempts": "6",
            "date": "2018-08-11"
        },
        {
            "id": "9",
            "name": "Macarena",
            "attempts": "7",
            "date": "2018-08-11"
        },
        {
            "id": "8",
            "name": "Andrea",
            "attempts": "8",
            "date": "2018-08-11"
        },
        {
            "id": "5",
            "name": "Mati",
            "attempts": "9",
            "date": "2018-08-11"
        },
        {
            "id": "4",
            "name": "Mile",
            "attempts": "10",
            "date": "2018-10-10"
        },
        {
            "id": "3",
            "name": "Nacho",
            "attempts": "20",
            "date": "2018-10-10"
        },
        {
            "id": "2",
            "name": "Fede",
            "attempts": "23",
            "date": "2018-11-26"
        },
        {
            "id": "13",
            "name": "Román",
            "attempts": "30",
            "date": "2018-08-11"
        }
    ]
}
```
	
### POST /api/top-ten/save.php

* 200 - OK --> Si se ha completado correctamente.
Este servicio obtiene la lista de Top Ten y verifica si el juegador enviado debe o no ingregesar.
Si debe ingresar borrará el último de la lista del Top Ten y guardará el registro.

Ejemplo:

- Request:

```json
	/api/top-ten/save.php
```

- Headers:

```json
	Content-Type: application/json
```

- Request body:

```json
	{"id":"1", "name":"Fede", "attempts":"12", "date":"2018-08-11"}
```

- Response:

```json
	[Status 200 OK]
```

### PUT /api/top-ten/reset.php

* Reiniciará el Top Ten, borrando todos los registros para comenzar desde cero.
