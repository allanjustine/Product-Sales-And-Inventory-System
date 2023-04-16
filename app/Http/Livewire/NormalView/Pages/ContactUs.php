<?php

namespace App\Http\Livewire\NormalView\Pages;

use App\Models\Contact;
use Livewire\Component;

class ContactUs extends Component
{

    public $name;
    public $email;
    public $message;

    public function submit()
    {
        $this->validate([
            'name'          =>          ['required', 'string', 'max:255'],
            'email'         =>          ['required', 'email', 'max:255'],
            'message'       =>          ['required', 'string', 'max:65535']
        ]);

        $contact = Contact::create([
            'name'          =>          $this->name,
            'email'         =>          $this->email,
            'message'       =>          $this->message
        ]);

        $contact->save();

        alert()->success('Submitted', 'Thank you for submitting feedbacks we appreciated it. Have a nice day.');

        return redirect('/contact-us');
    }

    public function render()
    {
        return view('livewire.normal-view.pages.contact-us');
    }
}