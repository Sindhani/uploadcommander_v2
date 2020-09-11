<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TicketReplies
 *
 * @property int $id
 * @property string $ticket_id
 * @property int|null $customer_id
 * @property int|null $supporter_id
 * @property string $reply_body
 * @property string|null $customer_attachment1
 * @property string|null $customer_attachment2
 * @property string|null $customer_attachment3
 * @property string|null $customer_attachment4
 * @property string|null $customer_attachment5
 * @property string|null $supporter_attachment1
 * @property string|null $supporter_attachment2
 * @property string|null $supporter_attachment3
 * @property string|null $supporter_attachment4
 * @property string|null $supporter_attachment5
 * @property int $is_supporter_replied
 * @property int $is_customer_replied
 * @property int|null $supporter
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image_msg
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies query()
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereCustomerAttachment1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereCustomerAttachment2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereCustomerAttachment3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereCustomerAttachment4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereCustomerAttachment5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereImageMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereIsCustomerReplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereIsSupporterReplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereReplyBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereSupporter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereSupporterAttachment1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereSupporterAttachment2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereSupporterAttachment3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereSupporterAttachment4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereSupporterAttachment5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereSupporterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TicketReplies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TicketReplies extends Model
{
    protected $fillable = ['ticket_id','customer_id','supporter_id','reply_body','customer_attachment1','customer_attachment2','customer_attachment3','customer_attachment4','customer_attachment5','supporter_attachment1','supporter_attachment2','supporter_attachment3','supporter_attachment4','supporter_attachment5','image_msg','is_supporter_replied','is_customer_replied','supporter'];
}
