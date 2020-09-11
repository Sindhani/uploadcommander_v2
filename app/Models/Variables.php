<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Variables
 *
 * @property int $id
 * @property int $language_id
 * @property string|null $name
 * @property string|null $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language $language
 * @method static \Illuminate\Database\Eloquent\Builder|Variables newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variables newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variables query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variables whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variables whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variables whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variables whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variables whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variables whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Variables extends Model
{
    protected $fillable = ['language_id','name','text'];

    public function language() {
        return $this->belongsTo(Language::class,'language_id','id','language');
    }
}
