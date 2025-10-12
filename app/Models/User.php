<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referrer_id',
        'username',
        'ip',
        'role',
        'wallet',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function statements()
    {
        return $this->hasMany(Statement::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function passports()
    {
        return $this->hasMany(Passport::class);
    }

    public function ssn()
    {
        return $this->hasMany(SSN::class);
    }

    public function einletter()
    {
        return $this->hasMany(Einletter::class);
    }

    public function voidchecks()
    {
        return $this->hasMany(Voidcheck::class);
    }

    public function utilities()
    {
        return $this->hasMany(Utility::class);
    }

    public function energies()
    {
        return $this->hasMany(Energy::class);
    }


    public function xfinity()
    {
        return $this->hasMany(Xfinity::class);
    }

    public function licenseImages()
    {
        return $this->hasMany(LicenseImage::class);
    }


    public function licenseBackground()
    {
        return $this->hasMany(LicenseBackground::class);
    }
    // public function invoices()
    // {
    //     return $this->hasMany(Invoice::class);
    // }

    // public function withdrawals()
    // {
    //     return $this->hasMany(Withdrawal::class);
    // }

    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    public function contractors()
    {
        return $this->hasMany(Contractor::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function paystubs()
    {
        return $this->hasMany(Paystub::class);
    }

    public function divorces()
    {
        return $this->hasMany(Divorce::class);
    }

    public function wills()
    {
        return $this->hasMany(Will::class);
    }

    public function lawyersLicenses()
    {
        return $this->hasMany(LawyerLicense::class);
    }

    public function sms()
    {
        return $this->hasMany(SMS::class);
    }

    public function vacates()
    {
        return $this->hasMany(Vacate::class);
    }

    public function laterent()
    {
        return $this->hasMany(LateRent::class);
    }

    public function leases()
    {
        return $this->hasMany(LeaseAgreement::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }


    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

/**
 * A user has a referrer.
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function referrer()
{
    return $this->belongsTo(User::class, 'referrer_id', 'id');
}

/**
 * A user has many referrals.
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function referrals()
{
    return $this->hasMany(User::class, 'referrer_id', 'id');
}


/**
 * The accessors to append to the model's array form.
 *
 * @var array
 */
protected $appends = ['referral_link'];

/**
 * Get the user's referral link.
 *
 * @return string
 */
public function getReferralLinkAttribute()
{
    return $this->referral_link = route('register', ['ref' => $this->username]);
}





}
