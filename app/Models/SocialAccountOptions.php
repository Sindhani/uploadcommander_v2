<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialAccountOptions
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $social_account_id
 * @property string|null $option_name
 * @property string|null $option_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer|null $customer
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions whereOptionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions whereOptionValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions whereSocialAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccountOptions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SocialAccountOptions extends Model
{
    /*public function socialAccount()
    {
        return $this->belongsTo(SocialAccounts::class,'social_account_id','id');
    }*/

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function option($name)
    {
        $option = self::where('option_name', $name)->first();
        if ($option) {
            return $option->option_value;
        }
        return null;
    }
}
