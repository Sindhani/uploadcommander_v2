<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomerAffiliates
 *
 * @property int $id
 * @property int $customer_id
 * @property float|null $commission_rate
 * @property int|null $total_acquired_customers
 * @property float|null $provided_benefit
 * @property float|null $total_repayment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereProvidedBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereTotalAcquiredCustomers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereTotalRepayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerAffiliates whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerAffiliates extends Model
{
    protected $fillable = ['customer_id','commission_rate','total_acquired_customers','provided_benefit','total_repayment'];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id','customers');
    }
}
