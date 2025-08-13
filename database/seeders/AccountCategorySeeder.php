<?php
namespace Database\Seeders;

use App\Models\AccountCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_categories')->insert([
            'name'     => 'Advertisement',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Volunteer Salary',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Admin Salary',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Rent',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Utility',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Others Expense',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'CareTaker Salary',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Cleaner Salary',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Food Manager Salary',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Graphic Designer Expense',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Gallary Expense',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Evening Snacks',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Office Expense',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Vat & Tax',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'CC Expense',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Loan Expense',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Office Food Cost',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Internet Bill',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Other Bill',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Service Charge',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Travel Cost',
            'type'     => 'Expense',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Cash Sale',
            'type'     => 'Income',

        ]);
        DB::table('account_categories')->insert([
            'name'     => 'CC Sale',
            'type'     => 'Income',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Food Sale',
            'type'     => 'Income',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Space Rent',
            'type'     => 'Income',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Account Recievable',
            'type'     => 'Income',
        ]);
        DB::table('account_categories')->insert([
            'name'     => 'Others Income',
            'type'     => 'Income',
        ]);
    }
}
