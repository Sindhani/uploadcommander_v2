<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\tickets
 *
 * @property int $id
 * @property string $ticket_id
 * @property int $customer_id
 * @property string $ticket_subject
 * @property string $ticket_body
 * @property string|null $attachment1
 * @property string|null $attachment2
 * @property string|null $attachment3
 * @property string|null $attachment4
 * @property string|null $attachment5
 * @property int $is_admin_replied
 * @property string $ticket_status
 * @property string|null $supporter
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $image_msg
 * @method static \Illuminate\Database\Eloquent\Builder|tickets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|tickets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|tickets query()
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereAttachment1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereAttachment2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereAttachment3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereAttachment4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereAttachment5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereImageMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereIsAdminReplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereSupporter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereTicketBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereTicketStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereTicketSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|tickets whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class tickets extends Model
{
     protected $fillable = ['ticket_id','customer_id','ticket_subject','ticket_body','attachment1','attachment2','attachment3','attachment4','attachment5','image_msg','is_admin_replied','ticket_status','supporter'];
}
