<?php
namespace App\Services;

class SpeediaService
{
    public function search($requestData)
    {
        // Datos ficticios
        return [
            'availability' => [
                [
                    'roomID' => 1,
                    'mealPlanID' => 1,
                    'isCancelable' => true,
                    'priceAmount' => 100.00
                ],
                [
                    'roomID' => 1,
                    'mealPlanID' => 2,
                    'isCancelable' => false,
                    'priceAmount' => 120.00
                ]
            ]
        ];
    }
}
