<?php

namespace App\Models;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $array)
 * @method static whereHas(string $string, \Closure $param)
 * @method static find(mixed $teamUser_id)
 * @property mixed $id
 * @property mixed $cart
 */
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use HasPanelShield;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public mixed $isSuperAdmin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'avatar_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::disk('DO-SPACES')
            ->url($this->avatar_url) : null;
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function businessHours(): HasMany
    {
        return $this->hasMany(BusinessHour::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function social(): HasOne
    {
        return $this->hasOne(Social::class);
    }

    public function hero(): HasOne
    {
        return $this->hasOne(Hero::class);
    }

    public function flexibility(): HasOne
    {
        return $this->hasOne(Flexibility::class);
    }

    public function faqdata(): HasOne
    {
        return $this->hasOne(FAQdata::class);
    }

    public function privacy(): HasOne
    {
        return $this->hasOne(Privacy::class);
    }

    public function about(): HasOne
    {
        return $this->hasOne(About::class);
    }

    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function terms(): HasOne
    {
        return $this->hasOne(Terms::class);
    }

    public function support(): HasOne
    {
        return $this->hasOne(Support::class);
    }

    public function   publicPage(): HasOne
    {
        return $this->hasOne(PublicPage::class);
    }

    public function sectionColors(): HasOne
    {
        return $this->hasOne(SectionColors::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function crudSettings(): HasMany
    {
        return $this->hasMany(CRUD_settings::class);
    }

    /**
     * @throws Exception
     */

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->hasRole('super_admin'),
            'team' => $this->hasRole('team_user'),
            'customer' => $this->hasRole('panel_user'),
            default => false,
        };
    }

    public function canComment(): bool
    {
        // your conditional logic here
        return true;
    }
    public function getIsSuperAdminAttribute(): bool
    {
        return $this->roles->pluck('name')->contains('super_admin');
    }

    public function getIsTeamUserAttribute(): bool
    {
        return $this->roles->pluck('name')->contains('team_user');
    }

    public function getIsPanelUserAttribute(): bool
    {
        return $this->roles->pluck('name')->contains('panel_user');
    }

    public function getFilamentName(): string
    {
        return "$this->first_name $this->last_name";
    }
}
