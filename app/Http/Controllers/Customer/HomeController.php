<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customers');
    }

    public function index() {
        if(\request()->user()->password_changed == 0 && \request()->user()->last_login == null) {

            $dateFormat = dateFormat();
            $timeFormat = timeFormat();

            $countryList = getCountryList();

            $timezones = getTimeZoneList();
            $language = Language::pluck('language_name','country_code');
            $language->prepend('Select Language','');
            return view('customer.address.index',compact('timezones','language', 'dateFormat', 'timeFormat', 'countryList'));
        } else {
            $customer = Customer::find(Auth::guard('customers')->user()->id);
            $customer->password_changed = 1;
            $customer->last_login = now();
            $customer->save();
            return view('customer.dashboard.index');
        }
    }
}
