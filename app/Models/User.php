<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'password',
        'img',
        'phone',
        'role',
        'isActived',
        'fonction_id',
    ];

    public function getImg()
    {
        if ($this->img && file_exists(public_path('storage/'.config('global.image_user').'/'.$this->img))) {
            $img = asset('storage/'.config('global.image_user').'/'.$this->img);
        } else {
            return false;
        }

        return $img;
    }

    public function format_date(string $date)
    {
        return Carbon::parse($date)->format('M d, Y');
    }
    
    public function diffForHumans(string $date)
    {
        return Carbon::parse($date)->diffForHumans();
    }

    public function fonction():BelongsTo
    {
        return $this->belongsTo(Fonction::class);
    }

    public function demandes():HasMany
    {
        return $this->hasMany(Demande::class, 'demandeur_id');
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
