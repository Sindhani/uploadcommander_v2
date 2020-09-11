<?php

namespace App\Exports;

use App\Models\Coupon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Coupon::all(['coupon_code_type','coupon_code','coupon_type','coupon_value','coupon_from_date','coupon_to_date','status']);
    }*/

    public function view(): View
    {
        $coupon = Coupon::all();
        return view('admin.coupon.coupon_export', [
            'coupons' => $coupon,
        ]);
    }
}
