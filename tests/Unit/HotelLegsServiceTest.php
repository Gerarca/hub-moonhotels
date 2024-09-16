<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\HotelLegsService;

class HotelLegsServiceTest extends TestCase
{
    protected $hotelLegsService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->hotelLegsService = new HotelLegsService();
    }

    public function testSearch()
    {
        // Datos ficticios
        $requestData = [
            'hotelId' => 1,
            'checkIn' => '2024-10-01',
            'checkOut' => '2024-10-05',
            'numberOfGuests' => 2,
            'numberOfRooms' => 1,
            'currency' => 'USD'
        ];

        $response = $this->hotelLegsService->search($requestData);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('results', $response);
        $this->assertCount(3, $response['results']);

        $this->assertEquals(1, $response['results'][0]['room']);
        $this->assertEquals(100.00, $response['results'][0]['price']);
        $this->assertTrue($response['results'][0]['canCancel']);
    }
}
