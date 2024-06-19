<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil pengaturan pertama atau buat data default jika tidak ada
        $settings = Setting::firstOrCreate(
            ['id' => 1],
            [
                'website_title' => 'Default Title',
                'website_description' => 'Default Description',
                'timezone' => 'UTC',
                'language' => 'en',
            ]
        );

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_title' => 'required|string|max:255',
            'website_description' => 'nullable|string|max:1000',
            'timezone' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tax' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.settings')
                ->withErrors($validator)
                ->withInput();
        }

        $settings = Setting::firstOrFail();

        $settings->website_title = $request->input('website_title');
        $settings->website_description = $request->input('website_description');
        $settings->timezone = $request->input('timezone');
        $settings->language = $request->input('language');

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('images'), $logoName);
            $settings->logo = 'images/' . $logoName;
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('images'), $faviconName);
            $settings->favicon = 'images/' . $faviconName;
        }

        $settings->tax = $request->input('tax');
        $settings->save();

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}
