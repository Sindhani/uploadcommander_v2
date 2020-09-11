<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmailSettings
 *
 * @property int $id
 * @property string|null $from_email
 * @property string|null $from_name
 * @property string|null $username
 * @property string|null $password
 * @property string|null $smtp_host
 * @property string|null $smtp_port
 * @property string|null $encryption
 * @property int $is_auth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereEncryption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereFromEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereIsAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereSmtpHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereSmtpPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmailSettings whereUsername($value)
 * @mixin \Eloquent
 */
class EmailSettings extends Model
{
    protected $fillable = ['from_email','from_name','username','password','smtp_host','smtp_port','encryption','is_auth'];
}
