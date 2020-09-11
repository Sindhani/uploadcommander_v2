<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ticket_history
 *
 * @property int $id
 * @property string $ticket_id
 * @property string $detail
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history query()
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ticket_history whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ticket_history extends Model
{
	protected $table = 'ticket_history';
     protected $fillable = ['ticket_id','detail'];
}
