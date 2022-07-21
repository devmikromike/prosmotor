<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ProsBlackListed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeCountBlackListed($query)
    {
      return $query
      ->count();
    }
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
        'reason' => 'Company has ' .$business['description']
      );
    }
    public function liquidations($data)
    {
    //  dump('liquidations');
    //  dump($data);
        $business['status'] = 'failed';
        $liquidations = $data['liquidations'][0];
        $business['lastType'] = $liquidations['type'];
        $business['regDate'] = $liquidations['registrationDate'];
        $business['vatId'] = $data['businessId'];
        $business['description'] = $liquidations['description'];
        $response = (new ProsBlackListed())->createStatus($business);
         Log::info('BlackList: [COMPLETED] '.$data['businessId']);
      return 1;
    }
    public function find($vatId)
    {
         Log::info(' ProsBlackListed Process! '.$vatId);

      if($model =  (new SELF())->where('vatId', $vatId )->first())
        {
          Log::info(' ProsBlackListed Process Response for!  '.$vatId);

           if($model->status !='')
           {
              Log::info(' Process Response  Status for!  '.$model->status);
                return 1;
           }
            Log::info(' Process Response  Status for!  '.$model->status);
          return 0;
        }
      return 0;
    }
    public function checkLastType()
    {
      //
    }
    /*
    public function checkStatus($vatId)
    {
      //
    }   */
}
