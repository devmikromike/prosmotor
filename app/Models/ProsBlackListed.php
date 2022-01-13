<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsBlackListed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blacklisted($vatId)
    {
      SELF::updateOrCreate([
        'vatId' => $vatId,
      ]);
      return $errors = array(
        'message' => 'Company blacklisted',
        'vatId' => $vatId,
        'reason' => 'No Company name on PRH Record for Vatid.'
      );
    }
    public function createStatus($business, $reason)
    {
      $type = $business['lastType'];
      SELF::updateOrCreate($business);
      return $errors = array(
        'message' => 'Company blacklisted',
        'vatId' => $business['vatId'],
        'reason' => 'Company has' .$reason
      );
    }
}
