<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = []; // make all your form input fields fillable

    public function userLocation()
    {
        return $this->hasOne(UserLocation::class);
    }
    public function getDeviceInformation(Request $request)
    {
        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));

        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();

        // Now you can access the device, platform, and browser information
        // and use it as needed

        return [
            'device' => $device,
            'platform' => $platform,
            'browser' => $browser,
        ];
    }

    public function getLastLoginDateTime()
    {
        return $this->last_login_at;
    }

    public function getLastLoginMethod()
    {
        $latestAudit = Audit::where('auditable_type', static::class)
            ->where('auditable_id', $this->id)
            ->where('event', 'Login')
            ->orWhere('event', 'created')
            ->orWhere('event', 'updated')
            ->orderBy('created_at', 'desc')
            ->first();

        return $latestAudit ? $latestAudit->event : null;
    }
    public static function generateUsername($username)
    {
        if ($username == null) {
            $username = Str::lower(Str::random(8));
        }

        if (User::where('username', $username)->exists()) {
            $new_username = $username . Str::lower(Str::random(3));
            $username = self::generateUsername($new_username);
        }

        return $username;
    }

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
}
