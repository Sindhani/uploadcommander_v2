<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductFeatures
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $version
 * @property string|null $is_active
 * @property string|null $product_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereProductType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductFeatures whereVersion($value)
 * @mixin \Eloquent
 */
class ProductFeatures extends Model
{
    protected $fillable = ['name','description','version','is_active','product_type'];
}
