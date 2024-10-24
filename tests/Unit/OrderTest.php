<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_store_a_new_orders()
    {
        // arrange
        $data = [
            'id' => 'A1000001',
            'name' => 'Carlos Cheung',
            'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
            'price' => 1500,
            'currency' => 'TWD',
        ];
        // action
        $response = $this->post('/api/orders', $data);
        // assert
        $response->assertStatus(200);
    }

    public function test_store_a_duplicate_orders()
    {
        // arrange
        $data1 = [
            'id' => 'A1000001',
            'name' => 'Carlos Cheung',
            'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
            'price' => 1500,
            'currency' => 'TWD',
        ];
        $data2 = [
            'id' => 'A1000001',
            'name' => 'Honor Cheung',
            'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
            'price' => 500,
            'currency' => 'TWD',
        ];
        // action
        $this->post('/api/orders', $data1);
        $response = $this->post('/api/orders', $data2);
        // assert
        $response->assertStatus(400);
    }

    /**
     * @dataProvider provide_invaild_data
     */
    public function test_invaild_data(array $data)
    {

        $response = $this->json('POST', 'api/orders', $data);
        echo json_encode($response->getOriginalContent());
        $response->assertStatus(400);
    }

    public function provide_invaild_data()
    {
        $data = [
            [[
                'id' => '',
                'name' => 'Carlos Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => '',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos嗨Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'carloscheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos Cheung',
                'address' => ['city' => '', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => '', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => ''],
                'price' => 1500,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => '',
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 2050,
                'currency' => 'TWD',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => '',
            ]],
            [[
                'id' => 'A1000001',
                'name' => 'Carlos Cheung',
                'address' => ['city' => 'new-taipei-city', 'district' => 'tamsui-district', 'street' => 'beixin-road'],
                'price' => 1500,
                'currency' => 'HKD',
            ]],
        ];
        return $data;
    }
}
