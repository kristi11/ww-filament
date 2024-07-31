<?php

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Firefly\FilamentBlog\Traits\HasBlog;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LaraZeus\Boredom\Concerns\HasBoringAvatar;
use Override;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasBoringAvatar;
    use HasFactory;
    use HasPanelShield;
    use HasRoles;
    use Notifiable;
    use HasBlog;

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

    //    public function seo(): HasOne
    //    {
    //        return $this->hasOne(Seo::class);
    //    }

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
     * @throws Exception
     */
    #[Override]
    public function canAccessPanel(Panel $panel): bool
    {
        // Check the panel ID to determine access rules
        if ($panel->getId() === 'admin') {
            // Only super admins can access the 'admin' panel
            return $this->hasRole('super_admin');
        } elseif ($panel->getId() === 'team') {
            // Allow access to the 'customer' panel for customers
            return $this->hasRole('team_user');
        } elseif // Check the panel ID to determine access rules
        ($panel->getId() === 'customer') {
            // Allow access to the 'customer' panel for customers
            return $this->hasRole('panel_user');
        } else {
            // Deny access to all other panels
            return false;
        }
    }

    public function canComment(): bool
    {
        // your conditional logic here
        return true;
    }

    public function avatarName(): Attribute
    {
        return new Attribute(
            get: fn () => $this->name // or $this->>email or $this->>username or Str::random()
        );
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

//    protected static function booted(): void
//    {
//        static::addGlobalScope(new OwnerScope);
//    }
}
