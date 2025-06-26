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
 * User Model
 *
 * @method static create(array $array)
 * @method static whereHas(string $string, \Closure $param)
 * @method static find(mixed $id)
 *
 * @property int $id
 * @property Cart|null $cart
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $avatar_url
 * @property \DateTime|null $email_verified_at
 */
class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use Billable;
    // Authentication related traits
    use HasApiTokens;
    // Other functionality
    use HasFactory;

    use HasPanelShield;
    // Authorization related traits
    use HasRoles;

    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * Role name constants
     */
    private const ROLE_SUPER_ADMIN = 'super_admin';

    private const ROLE_TEAM_USER = 'team_user';

    private const ROLE_PANEL_USER = 'panel_user';

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

    /**
     * Avatar and display name methods
     */
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::disk(config('filesystems.disks.STORAGE_DISK'))
            ->url($this->avatar_url) : null;
    }

    public function getFilamentName(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * Panel access and permission methods
     *
     * @throws Exception
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->hasRole(self::ROLE_SUPER_ADMIN),
            'team' => $this->hasRole(self::ROLE_TEAM_USER),
            'customer' => $this->hasRole(self::ROLE_PANEL_USER),
            default => false,
        };
    }

    public function canComment(): bool
    {
        // your conditional logic here
        return true;
    }

    /**
     * Role accessor methods
     */
    public function getIsSuperAdminAttribute(): bool
    {
        $cacheKey = "user_{$this->id}_is_super_admin";

        return cache()->remember($cacheKey, now()->addMinutes(60), function () {
            return $this->roles->pluck('name')->contains(self::ROLE_SUPER_ADMIN);
        });
    }

    public function getIsTeamUserAttribute(): bool
    {
        $cacheKey = "user_{$this->id}_is_team_user";

        return cache()->remember($cacheKey, now()->addMinutes(60), function () {
            return $this->roles->pluck('name')->contains(self::ROLE_TEAM_USER);
        });
    }

    public function getIsPanelUserAttribute(): bool
    {
        $cacheKey = "user_{$this->id}_is_panel_user";

        return cache()->remember($cacheKey, now()->addMinutes(60), function () {
            return $this->roles->pluck('name')->contains(self::ROLE_PANEL_USER);
        });
    }

    /**
     * User profile related relationships
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function social(): HasOne
    {
        return $this->hasOne(Social::class);
    }

    /**
     * Business related relationships
     */
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

    /**
     * E-commerce related relationships
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Content and page relationships
     */
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

    public function publicPage(): HasOne
    {
        return $this->hasOne(PublicPage::class);
    }

    /**
     * Settings and configuration relationships
     */
    public function sectionColors(): HasOne
    {
        return $this->hasOne(SectionColors::class);
    }

    public function crudSettings(): HasMany
    {
        return $this->hasMany(CRUD_settings::class);
    }

    /**
     * Get the leads for the user.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
