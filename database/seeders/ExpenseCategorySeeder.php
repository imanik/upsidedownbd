<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expense_categories')->insert([
            'name'  => 'Advertisement',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Volunteer Salary',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Admin Salary',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Rent',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Utility',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Others',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'CareTaker Salary',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Cleaner Salary',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Food Manager Salary',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Graphic Designer Expense',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Gallery Expense',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Evening Snacks',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Office Expense',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Vat & Tax',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'CC Expense',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Loan Expense',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Office Food Cost',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Internet Bill',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Other Bill',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Service Charge',
        ]);
        DB::table('expense_categories')->insert([
            'name'  => 'Travel Cost',
        ]);
    }
}
