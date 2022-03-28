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
      dd($business);

      $type = $business['lastType'];
      SELF::updateOrCreate($business);
      return $errors = array(
        'message' => 'Company blacklisted',
        'vatId' => $business['vatId'],
        'reason' => 'Company has' .$reason
      );
    }
    public function liquidations($data)
    {
      dump('liquidations');
      dd($data);
      $status = 'failed';
      $details = $data['liquidations'][0];
      $business['lastType'] = $liquidations[0]['type'];
      $business['regDate'] = $liquidations[0]['registrationDate'];
      $business['vatId'] = $data['businessId'];
      $reason = $liquidations[0]['description'];
      $response = (new ProsBlackListed())->createStatus($business, $reason);
    }
}
