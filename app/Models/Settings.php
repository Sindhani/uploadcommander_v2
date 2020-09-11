<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Settings
 *
 * @property int $id
 * @property string|null $payouts_minimum_amount
 * @property string|null $default_commision
 * @property string|null $cashout_day_1
 * @property string|null $cashout_day_2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCashoutDay1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCashoutDay2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereDefaultCommision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePayoutsMinimumAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{
    protected $fillable = ['payouts_minimum_amount', 'default_commision', 'cashout_day_1', 'cashout_day_2'];
}
