<?php

namespace Tests\Unit;

use App\Http\Controllers\OrderController;
use App\Models\Item;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;

class OrderControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function it_calculates_order_correctly()
    {
        $itemsIds = Item::pluck('id')->all();

        $requestData = [
            'items' => $itemsIds,
        ];

        $orderController = new OrderController();
        $request = $this->createRequestMock($requestData, 'POST');
        $response = $orderController->calculateOrder($request);
        $response->$this->assertStatus(200);
        $response->$this->assertViewHas(['checkout', 'total']);
        $checkoutData = $response->original['checkout'];
        $total = $response->original['total'];
        $this->assertEquals(270, $checkoutData['subtotal']);
        $this->assertEquals(30, $checkoutData['shipping']);
        $this->assertEquals(37.8, $checkoutData['vat']);
        $this->assertEquals(1, count($checkoutData['discounts']));
        $this->assertEquals(13.5, $total);
    }

    private function createRequestMock($data, $method = 'POST')
    {
        $request = Request::create('/dummy-url', $method, $data);

        return $request;
    }

}
