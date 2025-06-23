<?php

namespace App\Livewire;

use App\Actions\Leads\CreateLeadFromForm;
use App\Models\Hero;
use Illuminate\Contracts\View\View;
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

    public function submit(CreateLeadFromForm $createLeadAction)
    {
        $this->validate();

        $lead = $createLeadAction->execute([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
        ]);

        if (!$lead) {
            $this->addError('form', 'Unable to submit form. Please try again later.');
            return;
        }

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
