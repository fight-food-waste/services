<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;

class LocalizationController extends Controller
{
    public function setLocale($locale)
    {
        if (array_key_exists($locale, Config::get('languages'))) {
            session()->put('locale', $locale);

            return redirect()->back();
        } else {
            return redirect()->back()->with('error', __('flash.localization_controller.locale_not_exist_error'));
        }
    }
}
