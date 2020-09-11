<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Media
 *
 * @property int $id
 * @property int $customer_id
 * @property string|null $name
 * @property string|null $path
 * @property string|null $thumb_path
 * @property string|null $type
 * @property string|null $size
 * @property string|null $width
 * @property string|null $height
 * @property string|null $provider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereThumbPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereWidth($value)
 * @mixin \Eloquent
 */
class Media extends Model
{
    protected $fillable = ['customer_id', 'name', 'path', 'type', 'size', 'provider'];
}
