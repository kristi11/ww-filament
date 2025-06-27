# Appointment Management

WittyWorkflow includes a comprehensive appointment scheduling system that integrates with email notifications and calendar systems.

## 🏗️ Appointment System Architecture

The appointment system consists of several key components:

- **Models**: `Appointment` and `Service` models manage the data structure
- **Booking Flow**: Users select services, available time slots, and complete bookings
- **Notifications**: Automatic emails for booking confirmation, reminders, and updates

## ⚙️ Setting Up Appointments

1. **Configure Business Hours**:
    - Navigate to the Business Hours section in the admin panel
    - Set your regular operating hours for each day of the week
    - Configure special hours for holidays or events

2. **Set Up Services**:
    - Create services that can be booked through the Services section
    - Define duration, price, and description for each service
    - Assign services to specific team members if needed

3. **Configure Email Templates**:
    - Customize email templates for appointment confirmations and reminders
    - Set up notification preferences for both staff and customers

## 📋 Managing Appointments

Appointments can be managed through the Filament admin panel:

1. **View Appointments**:
    - See all upcoming appointments in a calendar or list view
    - Filter by date, service, or status

2. **Create Appointments**:
    - Add appointments manually for walk-in customers

3. **Update Appointments**:
    - Reschedule appointments as needed
    - Change service or duration
    - Add notes or special requirements

4. **Cancel Appointments**:
    - Cancel with automatic notification to the customer
    - Optionally offer rebooking options

## 🔧 Customizing the Appointment System

The appointment system can be customized in several ways:

- **Booking Rules**: Modify booking rules in `app/Models/Appointment.php`
- **Email Templates**: Customize email templates in `resources/views/emails/appointments/`
- **Booking Form**: Extend the booking form in `resources/views/livewire/appointment-form.blade.php`

## 🔄 Integration with Other Features

The appointment system integrates with other WittyWorkflow features:

- **User Accounts**: Appointments are linked to user accounts for easy management
- **Email Notifications**: Automatic emails for appointment confirmations and reminders
- **Admin Dashboard**: Comprehensive appointment management in the admin panel

## 🚀 Best Practices

For optimal use of the appointment system:

- Configure business hours accurately to avoid booking conflicts
- Set realistic service durations to prevent scheduling issues
- Customize email templates to match your brand
- Regularly review and clean up old appointments

[Back to Top](../../README.md)

---

Last Updated: June 2025
