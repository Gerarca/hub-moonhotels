<?php
namespace App\Services;

class HotelLegsService
{
    public function search($requestData)
    {
        // Datos ficticios
        return [
            'results' => [
                [
                    'room' => 1,
                    'meal' => 1,
                    'canCancel' => true,
                    'price' => 100.00
                ],
                [
                    'room' => 1,
                    'meal' => 2,
                    'canCancel' => false,
                    'price' => 120.00
                ],
                [
                    'room' => 2,
                    'meal' => 1,
                    'canCancel' => true,
                    'price' => 130.00
                ]
            ]
        ];
    }
}
