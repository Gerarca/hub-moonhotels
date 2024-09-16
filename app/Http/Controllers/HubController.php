<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HotelLegsService;
use App\Services\TravelDoorXService;
use App\Services\SpeediaService;

class HubController extends Controller
{
    protected $hotelLegsService;
    protected $travelDoorXService;
    protected $speediaService;

    public function __construct(HotelLegsService $hotelLegsService, TravelDoorXService $travelDoorXService, SpeediaService $speediaService)
    {
        $this->hotelLegsService = $hotelLegsService;
        $this->travelDoorXService = $travelDoorXService;
        $this->speediaService = $speediaService;
    }

    public function search(Request $request)
    {
        $hubRequest = $request->all();

        $hotelLegsResponse = $this->hotelLegsService->search($hubRequest);
        $travelDoorXResponse = $this->travelDoorXService->search($hubRequest);
        $speediaResponse = $this->speediaService->search($hubRequest);

        $finalResponse = $this->aggregateResponses($hotelLegsResponse, $travelDoorXResponse, $speediaResponse);

        return response()->json($finalResponse);
    }

    protected function aggregateResponses($hotelLegsResponse, $travelDoorXResponse, $speediaResponse)
    {
        $rooms = [];

        foreach ($hotelLegsResponse['results'] as $result) {
            $rooms[$result['room']][] = [
                'mealPlanId' => $result['meal'],
                'isCancellable' => $result['canCancel'],
                'price' => $result['price']
            ];
        }

        foreach ($travelDoorXResponse['roomsAvailable'] as $result) {
            $rooms[$result['roomId']][] = [
                'mealPlanId' => $result['mealPlanId'],
                'isCancellable' => $result['cancellable'],
                'price' => $result['rate']
            ];
        }

        foreach ($speediaResponse['availability'] as $result) {
            $rooms[$result['roomID']][] = [
                'mealPlanId' => $result['mealPlanID'],
                'isCancellable' => $result['isCancelable'],
                'price' => $result['priceAmount']
            ];
        }

        $formattedRooms = [];
        foreach ($rooms as $roomId => $rates) {
            $formattedRooms[] = [
                'roomId' => $roomId,
                'rates' => $rates
            ];
        }

        return ['rooms' => $formattedRooms];
    }
}

