<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        return view('dashboard.setting');
    }

    public function store(Request $request)
    {

        $messages = [];

        foreach ($request->all() as $name => $value) {
            if ($name != '_token') {
                if (!Setting::updateOrCreate(['name' => $name], ['value' => $value ?? ''])) {
                    $messages[] = Str::of($name)->replace('_', ' ')->ucfirst();
                }
            }
        }

        if (count($messages) > 0) {
            return back()->withInput()->with('fail', implode(', ', $messages) . ' updating failed!');
        } else {
            return back()->with('success', 'Settings updated.');
        }
    }
}
