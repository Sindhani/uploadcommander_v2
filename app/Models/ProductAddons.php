<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductAddons
 *
 * @property int $id
 * @property string|null $addon_name
 * @property int|null $social_account_limit
 * @property int|null $file_storage_size
 * @property float|null $monthly_pricing
 * @property float|null $yearly_pricing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereAddonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereFileStorageSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereMonthlyPricing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereSocialAccountLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAddons whereYearlyPricing($value)
 * @mixin \Eloquent
 */
class ProductAddons extends Model
{
    protected $fillable = ['addon_name', 'social_account_limit', 'file_storage_size', 'monthly_pricing', 'yearly_pricing'];
}
