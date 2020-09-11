<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SocialLinks
 *
 * @property int $id
 * @property string|null $account
 * @property string|null $account_name
 * @property string|null $button_title
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $button_type
 * @property int|null $visibility
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereButtonTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereButtonType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialLinks whereVisibility($value)
 * @mixin \Eloquent
 */
class SocialLinks extends Model
{
    protected $guarded = [];

    public function getCreatedAtAttribute()
    {
        return  Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
}
