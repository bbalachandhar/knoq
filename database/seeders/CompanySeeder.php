<?php

namespace Database\Seeders;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{

    public function run(): void
    {
        Company::updateOrCreate(
            ['email' => 'info@infitri.com'],
            [
                'name' => "infitri limited",
                'phone' => "9524139984",
                'owner_name' => "b.balachandhar",
                'address' => "london",
                'logo' => "placeholder_logo.svg",
                'sidebar_logo' => "placeholder_sidebar_logo.svg",
            ]
        );
    }
}
