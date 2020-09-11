<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feed
 *
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property string|null $link_type
 * @property string $clicks_count
 * @property int|null $customer_id
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereClicksCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereLinkType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feed whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Feed extends Model
{
    protected $guarded = [];
    public function statisticsButtons(){
        return $this->hasMany(ButtonStatistic::class);
    }

}

