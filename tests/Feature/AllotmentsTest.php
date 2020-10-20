<?php

namespace Tests\Feature;

use App\Models\Allotment;
use App\Models\City;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AllotmentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function allotments_page_shows_allotments_correctly()
    {
        $city = City::factory()->create();

        $allotment1 = Allotment::factory()->hasLots(10)->create(['area' => '52.51']);
        $allotment2 = Allotment::factory()->hasLots(5)->create(['area' => '150.58']);

        $this->actingAs(User::factory()->create())
            ->get('/allotments')
            ->assertSeeInOrder([$allotment1->title, $allotment2->title])
            ->assertSeeInOrder(['52,51', '150,58'])
            ->assertSeeInOrder(['<span class="lotCount">10</span>', '<span class="lotCount">5</span>'], false)
            ->assertSee($city->full_name);
    }
}
