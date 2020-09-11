<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ApiSettings
 *
 * @property int $id
 * @property string|null $stripe_mode
 * @property string|null $stripe_key
 * @property string|null $stripe_secret_key
 * @property string|null $stripe_webhook_signing_secret_key
 * @property string|null $stripe_enable_recurring_payment
 * @property string|null $paypal_mode
 * @property string|null $paypal_client_id
 * @property string|null $paypal_client_secret
 * @property string|null $paypal_webhook
 * @property string|null $paypal_enable_subscription
 * @property string|null $google_api_key
 * @property string|null $google_client_id
 * @property string|null $recaptcha_site_key
 * @property string|null $recaptcha_secret_key
 * @property string|null $enable_recaptcha
 * @property string|null $dropbox_api_key
 * @property string|null $onedrive_client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereDropboxApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereEnableRecaptcha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereGoogleApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereGoogleClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereOnedriveClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings wherePaypalClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings wherePaypalClientSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings wherePaypalEnableSubscription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings wherePaypalMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings wherePaypalWebhook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereRecaptchaSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereRecaptchaSiteKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereStripeEnableRecurringPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereStripeKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereStripeMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereStripeSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereStripeWebhookSigningSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApiSettings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ApiSettings extends Model
{
    protected $fillable = ['stripe_mode','stripe_key','stripe_secret_key','stripe_webhook_signing_secret_key','stripe_enable_recurring_payment','paypal_mode','paypal_client_id','paypal_client_secret','paypal_webhook','paypal_enable_subscription','google_api_key','google_client_id','recaptcha_site_key','recaptcha_secret_key','enable_recaptcha','dropbox_api_key','onedrive_client_id'];
}
