<?php

namespace Database\Seeders;

use App\Models\PaymentPlan;
use Illuminate\Database\Seeder;

class PaymentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentPlan::create([
            'name' => 'IGP-M Anual',
            'description' => 'Plano com entrada de 5% + parecelas com juros',
            'min_down_payment' => 5,
            'installment_indexes' => collect([
                ['installments' => 12, 'index' => 0.0888],
                ['installments' => 15, 'index' => 0.0721],
                ['installments' => 16, 'index' => 0.0679],
                ['installments' => 18, 'index' => 0.0610],
                ['installments' => 20, 'index' => 0.0563],
                ['installments' => 24, 'index' => 0.0480],
                ['installments' => 30, 'index' => 0.0396],
                ['installments' => 36, 'index' => 0.0341],
                ['installments' => 40, 'index' => 0.0313],
                ['installments' => 50, 'index' => 0.0263],
                ['installments' => 60, 'index' => 0.0230],
                ['installments' => 70, 'index' => 0.0206],
                ['installments' => 80, 'index' => 0.0188],
                ['installments' => 90, 'index' => 0.0174],
                ['installments' => 100, 'index' => 0.0163],
                ['installments' => 110, 'index' => 0.0154],
                ['installments' => 120, 'index' => 0.0146],
                ['installments' => 150, 'index' => 0.0130],
                ['installments' => 180, 'index' => 0.0121]
            ])
        ]);
    }
}
