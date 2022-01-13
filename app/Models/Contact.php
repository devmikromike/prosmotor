<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function extractContact($contacts, $vatId)
    {
      $phone ='';
      $www = '';
      $mobile = '';
      $phone_value = '';
      $www_value = '';
      $mobile_value = '';

      foreach($contacts as $contact)
      {
        if($contact['version']===1){
          if($contact['language']=== 'EN'){
                if($contact['type'] === 'Telephone')
                {
                    $phone = 'phone';
                    $phone_value = $contact['value'];
                }
                if($contact['type'] === 'Website address')
                {
                    $www = 'www';
                    $www_value = $contact['value'];
                }
                if($contact['type'] === 'Mobile phone')
                {
                    $mobile = 'mobile';
                    $mobile_value = $contact['value'];
                }
            }
          }
          $contact = array(
            $phone => $phone_value,
            $mobile => $mobile_value
          );
      }

       SELF::saveContact($contact);
       Prospect::saveWww($www_value, $vatId);
    }
    public function saveContact($contact)
    {
      SELF::updateOrCreate($contact);
    }
}
