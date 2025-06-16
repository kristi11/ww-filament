<?php

namespace App\Livewire;

use App\Mail\LeadNotification;
use App\Models\Hero;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class LeadForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';
    public $success = false;

    protected $rules = [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'nullable',
        'message' => 'nullable',
    ];

    public function submit()
    {
        $this->validate();

        // Get the admin user to associate the lead with
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->first();

        if (!$admin) {
            $this->addError('form', 'Unable to submit form. Please try again later.');
            return;
        }

        // Create the lead
        $lead = Lead::create([
            'user_id' => $admin->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'status' => 'new',
            'has_new_reply' => false,
        ]);

        // Send email notification to admin
        Mail::to($admin->email)->send(new LeadNotification($lead));

        // Reset the form
        $this->reset(['name', 'email', 'phone', 'message']);
        $this->success = true;
    }

    public function render(): View
    {
        $hero = cache()->remember('lead_form_hero', now()->addMinutes(60), function () {
            return Hero::first();
        });

        return view('livewire.lead-form', [
            'hero' => $hero,
        ]);
    }
}
