<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Packages
 *
 * @property int $id
 * @property string|null $subscription_name
 * @property int|null $social_account_limit
 * @property int|null $file_storage_size
 * @property int|null $file_size
 * @property string|null $monthly_pricing
 * @property string|null $yearly_pricing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customers
 * @method static \Illuminate\Database\Eloquent\Builder|Packages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Packages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Packages query()
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereFileStorageSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereMonthlyPricing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereSocialAccountLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereSubscriptionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Packages whereYearlyPricing($value)
 * @mixin \Eloquent
 */
class Packages extends Model
{
    protected $table = 'packages';

    protected $fillable = ['subscription_name', 'social_account_limit', 'file_storage_size', 'file_size', 'monthly_pricing', 'yearly_pricing'];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
}
