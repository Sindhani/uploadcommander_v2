<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property int|null $package_id
 * @property string|null $coupon_code_type
 * @property int|null $no_of_coupon
 * @property string|null $coupon_code
 * @property string|null $coupon_type
 * @property string|null $coupon_value
 * @property string|null $coupon_from_date
 * @property string|null $coupon_from_time
 * @property string|null $coupon_to_date
 * @property string|null $coupon_to_time
 * @property int|null $coupon_code_used
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Packages|null $packages
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponCodeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponCodeUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponFromDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponFromTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponToDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponToTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereNoOfCoupon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Coupon extends Model
{
    protected $fillable = ['coupon_code_type','no_of_coupon','coupon_code','coupon_type','coupon_value','coupon_from_date','coupon_to_date','package_id','coupon_code_used','coupon_from_time','coupon_to_time','status'];

    public function packages()
    {
        return $this->belongsTo(Packages::class,'package_id','id');
    }
}
