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

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    const USER_STATUSES_TEXT = [
        self::STATUS_ACTIVE => 'فعال',
        self::STATUS_DEACTIVE => 'غیرفعال'
    ];

    const USER_STATUSES_ENUM = [
        self::STATUS_ACTIVE => 'active',
        self::STATUS_DEACTIVE => 'deactive'
    ];

    const GENDER_MALE = 2;
    const GENDER_FEMALE = 1;

    const USER_GENDER_TEXT = [
        self::GENDER_MALE => 'مرد',
        self::GENDER_FEMALE => 'زن'
    ];

    const USER_GENDER_ENUM = [
        self::GENDER_MALE => 'male',
        self::GENDER_FEMALE => 'female'
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
        return $this->morphMany(Address::class, 'addressable');
    }

    public function types()
    {
        return $this->belongsToMany(UserType::class, 'user_user_type');
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
            $request['national_code'] ?? false,
            fn($query, $request) => $query->where('national_code', $request)
        );

        $query->when(
            $request['mobile'] ?? false,
            fn($query, $request) => $query->where('mobile', 'LIKE', '%' . $request . '%')
        );

        $query->when(
            $request['email'] ?? false,
            fn($query, $request) => $query->where('email',  'LIKE', '%' . $request . '%')
        );

        $query->when(
            $request['gender'] ?? false,
            fn($query, $request) => $query->where('gender', $request)
        );
        $query->when(
            $request['password'] ?? false,
            fn($query, $request) => $query->where('password', $request)
        );
        $query->when(
            $request['user_type_id'] ?? false,
            fn($query, $request) => $query->whereHas('types', fn($q) => $q->where('user_type_id', $request))
        )->get();
    }
}
