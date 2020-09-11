<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmailTemplates
 *
 * @property int $id
 * @property string|null $template_name
 * @property string|null $subject
 * @property string|null $email_body
 * @property string|null $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates whereEmailBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailTemplates whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EmailTemplates extends Model
{
    protected $fillable = ['template_name','subject','email_body','is_active'];
}
