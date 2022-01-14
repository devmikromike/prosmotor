<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $phone;
    public $www;
    public $mobile;
    public $phone_value;
    public $www_value;
    public $mobile_value;

    public function extractContact($contacts, $vatId)
    {

      foreach($contacts as $contact)
      {
        if($contact['version']===1){
          if($contact['language']=== 'EN'){

                 $phone_value = '0';
                 $www_value = '0';
                 $mobile_value ='0';

                if($contact['type'] === 'Telephone')
                {
                     if(!empty($contact['value'])){
                       $phone = 'phone';
                       $phone_value = $contact['value'];
                       dump($phone_value);
                     }else {
                       $phone_value = '0';
                     }
                }
                if($contact['type'] === 'Website address')
                {
                   if(!empty($contact['value'])){
                     $www = 'www';
                     $www_value = $contact['value'];
                     dump($www_value);
                   } else {
                     $www_value = '0';
                   }
                }
                if($contact['type'] === 'Mobile phone')
                {
                  if(!empty($contact['value'])){
                    $mobile = 'mobile';
                    $mobile_value = $contact['value'];
                    dump($mobile_value);
                  }else {
                    $mobile_value ='0';
                  }
              }

              dump($phone_value,$mobile_value);

              $contact = array(
                'phone' => $phone_value,
                'mobile' => $mobile_value
              );
            }
          }
      }
      SELF::saveContact($contact);

       if(!empty($www_value)){
          Prospect::saveWww($www_value, $vatId);
       }

  //     Prospect::saveWww($www_value, $vatId);
    }
    public function saveContact($contact)
    {
      SELF::updateOrCreate($contact);
    }
}
