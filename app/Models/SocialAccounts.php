<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialAccounts
 *
 * @property int $id
 * @property int $customer_id
 * @property string|null $provider_id
 * @property string|null $provider_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SocialAccountOptions[] $socialAccountOptions
 * @property-read int|null $social_account_options_count
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts query()
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SocialAccounts whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SocialAccounts extends Model
{
    protected $fillable = ['customer_id','provider_id','provider_name'];

    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function socialAccountOptions()
    {
        //return $this->hasMany(SocialAccountOptions::class,'social_account_id','id');
        return $this->hasMany(SocialAccountOptions::class,'social_account_id','id');
    }

    public function createOptions($options)
    {
        $query = [];
        foreach ($options as $name => $value) {
            $query[] = ['option_name' => $name, 'option_value' => $value, 'customer_id' => $this->customer_id, 'social_account_id' => $this->id, 'created_at' => now()];
        }
        $this->socialAccountOptions()->insert($query);
    }

    public function option($name, $default = null)
    {
        $option = $this->socialAccountOptions->where('customer_id', $this->customer_id)->where('option_name', $name)->first();
        if (!$option) {
            return $default;
        }
        return $option->option_value;
    }
}
