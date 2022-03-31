<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsBlackListed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blacklisted($vatId, $reason)
    {
        $business = array();
        $business['status'] = 'failed';
        $business['vatId'] = $vatId;
        $business['description'] = $reason;

        SELF::createStatus($business);

      return $errors = array(
        'message' => 'Company blacklisted',
        'vatId' => $vatId,
        'reason' => 'No Company name on PRH Record for Vatid.'
      );
    }
    public function createStatus($business)
    {
      // $type = $business['lastType'];
      SELF::updateOrCreate($business);
      return $errors = array(
        'message' => 'Company blacklisted',
        'vatId' => $business['vatId'],
        'reason' => 'Company has' .$business['description']
      );
    }
    public function liquidations($data)
    {
      dump('liquidations');
      dump($data);
      $business['status'] = 'failed';
      $details = $data['liquidations'][0];
      $business['lastType'] = $liquidations[0]['type'];
      $business['regDate'] = $liquidations[0]['registrationDate'];
      $business['vatId'] = $data['businessId'];
      $business['description'] = $liquidations[0]['description'];
      $response = (new ProsBlackListed())->createStatus($business);
    }
}
