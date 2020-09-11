<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DocumentTemplates
 *
 * @property int $id
 * @property string|null $template_name
 * @property string|null $subject
 * @property string|null $email_body
 * @property string|null $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates whereEmailBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentTemplates whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DocumentTemplates extends Model
{
    protected $fillable = ['template_name','subject','email_body','is_active'];
}
