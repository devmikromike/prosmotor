<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prospect;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
      'title', 'name', 'email','phone', 'mobile'
    ];

    public $phone;
    public $www;
    public $mobile;
    public $phone_value;
    public $www_value;
    public $mobile_value;

    public function prospects()
    {
      return $this->belongsToMany(Prospect::class);
    }

    public function extractContact($contacts, $vatId)
    {
      $phone_value = '0';
      $www_value = '0';
      $mobile_value ='0';

      foreach($contacts as $contact)
      {
        if($contact['version']===1){
          if($contact['language']=== 'EN'){
                if($contact['type'] === 'Telephone')
                {
                     if(!empty($contact['value'])){
                       $phone = 'phone';
                       $phone_value = $contact['value'];

                     }else {
                       $phone_value = '0';
                     }
                }
                if($contact['type'] === 'Website address')
                {
                   if(!empty($contact['value'])){
                     $www = 'www';
                     $www_value = $contact['value'];

                   } else {
                     $www_value = '0';
                   }
                }
                if($contact['type'] === 'Mobile phone')
                {
                  if(!empty($contact['value'])){
                    $mobile = 'mobile';
                    $mobile_value = $contact['value'];

                  }else {
                    $mobile_value ='0';
                  }
              }

            }
          }
          $contact  = array(
          'phone' => $phone_value,
          'mobile' => $mobile_value
        );
      }

      $contacts = SELF::saveContact($contact);
      $contacts->prospects()->attach($contacts->id);

       if(!empty($www_value)){
          Prospect::saveWww($www_value, $vatId);
       }

  //     Prospect::saveWww($www_value, $vatId);
    }
    public function saveContact($contact)
    {
      $saved = SELF::updateOrCreate($contact);
      return $saved;
    }
}
