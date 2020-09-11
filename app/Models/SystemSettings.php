<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SystemSettings
 *
 * @property int $id
 * @property int $maintenance_mode
 * @property string|null $website_name
 * @property string|null $website_description
 * @property string|null $website_keywords
 * @property string|null $logo
 * @property string|null $favicon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereFavicon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereMaintenanceMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereWebsiteDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereWebsiteKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SystemSettings whereWebsiteName($value)
 * @mixin \Eloquent
 */
class SystemSettings extends Model
{
    protected $fillable = ['maintenance_mode','website_name','website_description','website_keywords','logo','favicon'];
}
