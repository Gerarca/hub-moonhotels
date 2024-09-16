<?php
namespace App\Services;

class TravelDoorXService
{
    public function search($requestData)
    {
        // Datos ficticios
        return [
            'roomsAvailable' => [
                [
                    'roomId' => 1,
                    'mealPlanId' => 1,
                    'cancellable' => true,
                    'rate' => 100.00
                ],
                [
                    'roomId' => 1,
                    'mealPlanId' => 2,
                    'cancellable' => false,
                    'rate' => 120.00
                ]
            ]
        ];
    }
}
