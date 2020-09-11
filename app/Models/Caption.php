<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Caption
 *
 * @property \Carbon\Carbon $created_at
 * @property int            $id
 * @property \Carbon\Carbon $updated_at
 * @property string|null $caption_name
 * @property string|null $caption_content
 * @method static \Illuminate\Database\Eloquent\Builder|Caption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Caption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Caption query()
 * @method static \Illuminate\Database\Eloquent\Builder|Caption whereCaptionContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Caption whereCaptionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Caption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Caption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Caption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Caption extends Model
{
    protected $fillable = ['caption_name', 'caption_content', 'customer_id'];
}
