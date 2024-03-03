<?php

namespace App\Http\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;

class Contact extends Component
{
    public $full_name;
    public $email;
    public $message;
    public $feedback_message = '';
 
    protected $rules = [
        'full_name' => 'required|string',
        'email' => 'required|email',
        'message' => 'required|string',
    ];

    public function contact_submit()
    {
        $this->validate();
 
        // Execution doesn't reach here if validation fails.
        
        $contact = new ContactMessage();
        $contact->full_name = $this->full_name;
        $contact->email = $this->email;
        $contact->message = $this->message;
        $contact->save();
        $this->feedback_message = "Your message submitted successfully.";
        $this->full_name = null;
        $this->email = null;
        $this->message = null;
    }
    public function render()
    {
        return view('livewire.contact')->extends('layouts.app');
    }

    
}
