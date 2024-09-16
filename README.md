<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

#### Prueba técnica ejemplo HUB de Moonhotels
Moonhotels, es una empresa que vende estancias en habitaciones de hotel. Su producto
principal es un motor de reservas que se conecta a proveedores externos para devolver la
disponibilidad de habitaciones, aplicando al mismo tiempo las reglas de negocio de
Moonhotels.
Como solución a la deuda técnica que ha ido aumentando en los últimos años, decidieron
crear un nuevo HUB que se encargará de solicitar información a los proveedores y de
agregar los resultados en una respuesta única y consolidada.
Este nuevo HUB tendrá solo un método, Search, que ejecutará el siguiente flujo:
1. Recibir una solicitud de búsqueda en un formato común (formato HUB).
2. Traducir la solicitud de búsqueda del HUB a múltiples solicitudes de búsqueda, una para
cada proveedor. Todos los proveedores tienen un formato de búsqueda diferente.
3. Traducir cada respuesta de los proveedores (en un formato diferente para cada uno) a
una respuesta en el formato del HUB.
4. Agregar las diferentes respuestas en una sola.
El HUB se conectará a muchos proveedores diferentes: HotelLegs, TravelDoorX, Speedia,
etc.
Objetivo:
Tu tarea es desarrollar el dominio del HUB. Para una fase inicial del proyecto, hay dos tareas
principales:
1. Crear el sistema HUB que permita conectarse con varios proveedores.
2. Crear la integración del proveedor HotelLegs.
Como resumen, debes implementar:
• El conector para HotelLegs que, dada una solicitud de búsqueda del HUB, llame a la API de
HotelLegs y devuelva una respuesta en el formato del HUB.
• La infraestructura del HUB que, dada una solicitud del HUB, llame a todos los conectores
disponibles, devuelva sus respuestas y las agregue en una única respuesta.
Requisitos:
1. Lenguaje de programación:
 - PHP
 - Framework: Laravel
2. Proyecto funcional y ejecutable con código fuente completo.
3. Instrucciones de ejecución del proyecto y/o documentación son altamente
recomendadas.
4. Los requisitos de negocio mencionados en el objetivo deben cumplirse.
Puntos Adicionales:
1. Frontend con Vue: El desarrollo del frontend debe realizarse utilizando Vue.js y Pinia
para el manejo del estado, permitiendo que los usuarios interactúen con el HUB a través de
una interfaz web.
2. Pruebas Técnicas: Incluir pruebas unitarias básicas que cubran la lógica del HUB y del
conector HotelLegs mediante PHPUnit y Jest.
Modelos JSON
• Formato de Búsqueda del HUB:
```
{
"hotelId": 1,
"checkIn": "2018-10-20",
"checkOut": "2018-10-25",
"numberOfGuests": 3,
"numberOfRooms": 2,
"currency": "EUR"
}
• Respuesta del HUB:
{
"rooms": [
 {
 "roomId": 1,
 "rates": [
 {
 "mealPlanId": 1,
 "isCancellable": false,
 "price": 123.48
 },
 {
 "mealPlanId": 1,
 "isCancellable": true,
 "price": 150.00
 }
 ]
 },
 {
 "roomId": 2,
 "rates": [
 {
 "mealPlanId": 1,
 "isCancellable": false,
 "price": 148.25
 },
 {
 "mealPlanId": 2,
 "isCancellable": false,
 "price": 165.38
 }
 ]
 }
]
}
• Formato de Búsqueda de HotelLegs:
{
"hotel": 1,
"checkInDate": "2018-10-20",
"numberOfNights": 5,
"guests": 3,
"rooms": 2,
"currency": "EUR"
}
• Respuesta de HotelLegs:
{
"results": [
 {
 "room": 1,
 "meal": 1,
 "canCancel": false,
 "price": 123.48
 },
 {
 "room": 1,
 "meal": 1,
 "canCancel": true,
 "price": 150.00
 },
 {
 "room": 2,
 "meal": 1,
 "canCancel": false,
 "price": 148.25
 },
 {
 "room": 2,
 "meal": 2,
 "canCancel": false,
 "price": 165.38
 }
]
}
```

#### clone 
```
> git clone  git@github.com:Gerarca/hub-moonhotels.git
> cd hub-moonhotels
> rename file .env.example to .env
> composer install
> php artisan key:generate
> npm install
> php artisan serve
> npm run dev

```

for run test unit
```
> php vendor/bin/phpunit
PHPUnit 11.3.5 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.4
Configuration: C:\Users\userName\OneDrive\Documents\Laravel\hub-moonhotels\phpunit.xml

...                                                                 3 / 3 (100%)

Time: 00:00.566, Memory: 26.00 MB

OK (3 tests, 8 assertions)
```
