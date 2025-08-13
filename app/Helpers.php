<?php

namespace App;

use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\Income;
use Carbon\Carbon;
use App\Models\AccountCategory;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Helpers
{
    public static function getAdminEmailList($branch_id)
    {
        $email_list = User::where('is_admin', true)->orWhere(function ($query) use($branch_id) {
            $query->where('branch_id', $branch_id);
            $query->where('role_id', 1);
        })->pluck('email')->toArray();

        return $email_list;
    }

    public static function duePayment()
    {
        $status     = false;
        $message    = null;
        if (Auth::user()) {
            $ticket_count = Ticket::where('customer_id', Auth::id())->where('payment_status', '!=', 'paid')->count();

            if ($ticket_count) {
                $status     = true;
                $message    = 'Have ' . $ticket_count . ' Payment Due!!!';
            }
        }
        $params = [
            'status'    => $status,
            'message'   => $message,
        ];
        return $params;
    }

    public static function greeting()
    {
        $hours = date('H');
        $greeting = 'Good ';
        $greeting .= $hours < 12 ? 'Morning' : null;
        $greeting .= $hours >= 12 && $hours < 15 ? 'Noon' : null;
        $greeting .= $hours >= 15 && $hours < 17 ? 'Afternoon' : null;
        $greeting .= $hours >= 17 && $hours < 19 ? 'Evening' : null;
        $greeting .= $hours >= 19 ? 'Night' : null;

        return $greeting;
    }

    public static function trans($number)
    {
        $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
        $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];

        if (App::getLocale() == "en") {
            return $number;
        }
        return str_replace($en, $bn, $number);
    }

    public static function asText($text)
    {
        return ucwords(str_replace('_', '-', str_replace('-', ' ', $text)));
    }

    public static function asValue($text)
    {
        return strtolower(str_replace(' ', '-', str_replace('-', '_', $text)));
    }

    public static function asValueRev($text)
    {
        return str_replace('_', '-', str_replace('-', ' ', $text));
    }

    public static function generateSlug($name)
    {
        $slug = Str::slug($name);
        while (User::where('slug', $slug)->first()) {
            $slug = Str::slug($name . " " . Str::random(3));
        }
        return $slug;
    }

    public static function directoryCheck($full_path)
    {
        $folders = explode("/", $full_path);
        $path = "";
        foreach ($folders as $folder) {
            $path .= $folder . "/";
            if (!is_dir($path)) {
                mkdir($path);
            }
        }
        return $full_path;
    }

    public static function isRouteValid($route_ref = null)
    {
        $user = User::find(Auth::guard('web')->id());

        $valid_routes = [
            "dashboard",
            "customer.*",
        ];

        if ($user->status == "active" && $user->role && !empty($user->role->permissions)) {
            $permissions = json_decode($user->role->permissions, true);

            foreach (config('permission') as $name => $items) {
                foreach ($items as $item => $route) {
                    if (isset($permissions[$name]) && isset($permissions[$name][$item]) && $permissions[$name][$item] == "on") {
                        if (is_array($route)) {
                            $route = array_values($route);
                            $valid_routes = array_merge($valid_routes, $route);
                        } else {
                            $valid_routes[] = $route;
                        }
                    }
                }
            }
        }

        if (empty($route_ref)) {
            $route_ref = request()->route()->getName();
        }

        return ($user->is_admin || in_array($route_ref, $valid_routes));
    }

    public static function getExpenseSumByDate($date)
    {
        $transactions = Transaction::all();
        $transactions = $transactions->where('date', $date);
        $total_expense = $transactions->where('type','=','Expense')->sum('total');
        return $total_expense;
    }
    public static function getIncomeSumByDate($date)
    {
        $transactions = Transaction::all();
        $transactions = $transactions->where('date', $date);
        $total_income = $transactions->where('type','=','Income')->sum('total');
        return $total_income;
    }

    public static function getIncomeTotalByCategory($category_id)
    {
        $incomes = AccountCategory::find($category_id)->incomes;
        $total_income = $incomes->sum('total');

        return $total_income;
    }


    public static function getExpenseTotalByCategory($category_id)
    {
        $expenses = AccountCategory::find($category_id)->transactions;
  

        if (!$expenses){

              $total_expense = 0;

        }else{
            $total_expense = $expenses->sum('amount');
        }


        return $total_expense;
    }

}
