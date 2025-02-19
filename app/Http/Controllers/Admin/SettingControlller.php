<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        
        return back()->with('success', 'Settings updated successfully');
    }

    public function bankAccounts()
    {
        $bankAccounts = Setting::where('type', 'bank_account')->get();
        return view('admin.settings.bank-accounts', compact('bankAccounts'));
    }

    public function storeBankAccount(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
        ]);

        Setting::create([
            'key' => 'bank_account_' . time(),
            'value' => json_encode($validated),
            'type' => 'bank_account'
        ]);

        return back()->with('success', 'Bank account added successfully');
    }

    public function deleteBankAccount($id)
    {
        Setting::destroy($id);
        return back()->with('success', 'Bank account deleted successfully');
    }

    public function footer()
    {
        $footer = Setting::where('type', 'footer')->first();
        return view('admin.settings.footer', compact('footer'));
    }

    public function updateFooter(Request $request)
    {
        $validated = $request->validate([
            'contact_info' => 'required|string',
            'address' => 'required|string',
            'map_embed' => 'required|string',
            'social_media' => 'array'
        ]);

        Setting::updateOrCreate(
            ['type' => 'footer'],
            [
                'key' => 'footer_settings',
                'value' => json_encode($validated)
            ]
        );

        return back()->with('success', 'Footer settings updated successfully');
    }
}