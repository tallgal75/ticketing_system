<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  protected $fillable = [
      'id', 'ticket_reference', 'user_id',
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }
}
