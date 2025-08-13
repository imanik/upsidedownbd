<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->name,
            'status'            => 'active',
            'branch_id'         => rand(1, Branch::count()),
            'designation_id'    => rand(1, Designation::count()),
        ];
    }
}
