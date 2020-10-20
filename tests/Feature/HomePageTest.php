<?php

namespace Tests\Feature;

use App\Http\Livewire\SalesChartComponent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function home_page_shows_sales_chart()
    {
        $this->actingAs(User::factory()->create())
            ->get('/')
            ->assertSeeLivewire('sales-chart-component');
    }
}
