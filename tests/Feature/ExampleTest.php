<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
//     public function test_the_application_returns_a_successful_response(): void
//     {
//         $response = $this->get('portal/');
// // $response = $this->withoutExceptionHandling()->get('/');
//
// // dd($response);
//         $response->assertStatus(200);
//     }

// public function test_basic_test(): void
//     {
//         $response = $this->withoutDeprecationHandling()->get('/api/employee/data');
//
//
//     }
    //
    // public function test_basic_test(): void
    //     {
    //       $response = $this->get('/api/employee/data');
    //
    //       $response->ddHeaders();
    //
    //       $response->ddSession();
    //
    //       $response->dd();
    //     }
    //
    //
    public function test_making_an_api_request(): void
    {
        $response = $this->json('/');
//          $response->ddSession();
$response->assertStatus(201);

// $response->ddHeaders();
        // $response
        //     ->assertStatus(201)
        //     ->assertJson([
        //         'success' => true,
        //     ]);
    }

}
