<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'gender',
        'brith_date',
        'last_login',
        'national_code',
        'two_step_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    const CUSTOMER_TYPE = 1;
    const EMPLOEE_TYPE = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    const USER_TYPES_TEXT = [
        self::CUSTOMER_TYPE => 'کاربر',
        self::EMPLOEE_TYPE => 'کارشناس'
    ];

    const USER_TYPES_ENUM = [
        self::CUSTOMER_TYPE => 'custoemer',
        self::EMPLOEE_TYPE => 'emploee'
    ];

    const USER_STATUSES_TEXT = [
        self::CUSTOMER_TYPE => 'فعال',
        self::EMPLOEE_TYPE => 'غیرفعال'
    ];

    const USER_STATUSES_ENUM = [
        self::CUSTOMER_TYPE => 'active',
        self::EMPLOEE_TYPE => 'deactive'
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function addresses()
    {
        return $this->morphMany(File::class, 'addressable');
    }

    public function scopeFilter($query, $request)
    {

        $query->when(
            $request['id'] ?? false,
            fn($query, $request) => $query->where('users.id', $request)
        );

        $query->when(
            $request['first_name'] ?? false,
            fn($query, $request) => $query->where('first_name', 'LIKE', '%' . $request . '%')
        );

        $query->when(
            $request['last_name'] ?? false,
            fn($query, $request) => $query->where('last_name', 'LIKE', '%' . $request . '%')
        );

        $query->when(
            $request['full_name'] ?? false,
            fn($query, $request) => $query->where(DB::raw('concat(first_name, " ", last_name)'), 'LIKE', "%{$request}%")
        );

        $query->when(
            $request['identification_code'] ?? false,
            fn($query, $request) => $query->where('identification_num', $request)
        );

        $query->when(
            $request['mobile'] ?? false,
            fn($query, $request) => $query->where('mobile', 'LIKE', '%' . $request . '%')
        );

        $query->when(
            $request['password'] ?? false,
            fn($query, $request) => $query->where('password',  $request)
        );
    }
}
