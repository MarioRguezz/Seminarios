---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_d2e6e9773f8741e58c5e9832e9fdee01 -->
## login
Params: [email, password].

Método de autenticación de usuario, recibe el email y password
que compara contra la base de datos y devuelve la instancia correcta
de User o un error.

> Example request:

```bash
curl -X POST "http://localhost/Seminarios/public/api/usuarios/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/Seminarios/public/api/usuarios/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/usuarios/login`


<!-- END_d2e6e9773f8741e58c5e9832e9fdee01 -->

<!-- START_087fd47233e679f8842dc9069769b720 -->
## get: Cursos
params:[api_token].

Devuelve la lista de cursos de acuerdo al token de API enviado.

> Example request:

```bash
curl -X GET "http://localhost/Seminarios/public/api/cursos/get" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/Seminarios/public/api/cursos/get",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/cursos/get`

`HEAD api/cursos/get`


<!-- END_087fd47233e679f8842dc9069769b720 -->

<!-- START_04e6c32bbecbe84fe4618db91deec4c7 -->
## api/temas/get

> Example request:

```bash
curl -X GET "http://localhost/Seminarios/public/api/temas/get" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/Seminarios/public/api/temas/get",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/temas/get`

`HEAD api/temas/get`


<!-- END_04e6c32bbecbe84fe4618db91deec4c7 -->

