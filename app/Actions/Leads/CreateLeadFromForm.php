<?php

namespace App\Actions\Leads;

use App\Mail\LeadNotification;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CreateLeadFromForm
{
    /**
     * Create a new lead from form data and send notification to admin
     *
     * @param  array  $data  Form data containing name, email, phone, and message
     * @return Lead|null The created lead or null if no admin is found
     */
    public function execute(array $data): ?Lead
    {
        // Get the admin user to associate the lead with
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super_admin');
        })->first();

        if (! $admin) {
            return null;
        }

        // Create the lead
        $lead = Lead::create([
            'user_id' => $admin->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'] ?? null,
            'status' => 'new',
            'has_new_reply' => false,
        ]);

        // Send email notification to admin
        Mail::to($admin->email)->send(new LeadNotification($lead));

        return $lead;
    }
}
