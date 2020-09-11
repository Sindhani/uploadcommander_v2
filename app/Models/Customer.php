<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Model;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $package_id
 * @property string|null $affiliate_number
 * @property string|null $customer_number
 * @property string|null $company_name
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $password
 * @property string|null $remember_token
 * @property string|null $photo
 * @property string|null $street
 * @property string|null $street_no
 * @property string|null $zipcode
 * @property string|null $city
 * @property string|null $country
 * @property string|null $language
 * @property string|null $timezone
 * @property string|null $dateformat
 * @property string|null $timeformat
 * @property string $status
 * @property string $is_lock
 * @property int|null $password_changed
 * @property string|null $last_login
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CustomerAffiliates|null $affiliate
 * @property-read \App\Models\Packages|null $packages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SocialAccounts[] $socialAccounts
 * @property-read int|null $social_accounts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAffiliateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCustomerNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDateformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIsLock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePasswordChanged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereStreetNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTimeformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereZipcode($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $table = 'customers';

    protected $fillable = ['package_id','affiliate_number','customer_number', 'first_name', 'last_name', 'email', 'status', 'is_lock','password','parent_id','created_by','last_login','language','timezone','dateformat','timeformat', 'photo','street','city','zipcode','country','company_name','street_no'];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public static function getIncrementNum()
    {
        $objCustomer = Customer::latest()->first();
        if($objCustomer && $objCustomer->customer_number > 0) {
            $customerNum = $objCustomer->customer_number + 1;
        } else {
            $customerNum = 1;
        }

        return $customerNum;
    }

    public function packages()
    {
        return $this->belongsTo(Packages::class,'package_id','id');
    }

    public function affiliate()
    {
        return $this->hasOne(CustomerAffiliates::class);
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccounts::class,'customer_id','id');
    }

}
