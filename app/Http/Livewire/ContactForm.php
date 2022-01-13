<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $name;
//    public $email;
//    public $phone;
//    public $message;
//    public $company;

    protected $rules = [
        'name'   => 'required',
    //    'email' => 'required|email',
    //    'phone' => 'sometimes',
    //    'company' => 'sometimes'
    ];

    public function updated($propertyName)
    {
      $this->validateOnly($propertyName);
    }

    public function submitForm()
    {

      $contact = $this->validate();

        $contact['name'] = $this->name;
    //    $contact['email'] = $this->email;
    //    $contact['phone'] = $this->phone;
  //      $contact['message'] = $this->message;
  //      $contact['company'] = $this->company;



  //    $this->sendEmail($contact);

      $this->resetForm();

      session()->flash('success_message','Sent request and will get back to you shortly! ');
    //  return back()->with('success_message','Sent request and will get back to you shortly! ');
    }

    private function resetForm()
    {
      $this->name   = '';
    //  $this->email  = '';
    //  $this->phone = '';
    //  $this->company  = '';


    }

    public function sendEmail($contact)
    {
      Mail::to('support@mikromike.email')
      ->send(new ContactFormMail($contact))
      ->cc($contact->email);

    }
    public function render()
    {
        return view('livewire.contact-form');
    }
}
