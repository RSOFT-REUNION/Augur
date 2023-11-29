<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    // Show user follow with icons
    public function newsletterIcon()
    {
        if($this->newsletter) {
            return '<span class="bg-green-200 px-2 py-1 rounded-md text-sm"><i class="fa-solid fa-circle-check mr-2"></i>Abonné</span>';
        } else {
            return '<span class="bg-red-200 px-2 py-1 rounded-md text-sm"><i class="fa-solid fa-circle-xmark mr-2"></i>Non abonné</span>';
        }
    }

    // Get Created_at with the good date format
    public function getCreatedAt()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    // Avoir le numéro de téléphone de la personne avec un texte si non trouvée
    public function getPhone()
    {
        if($this->phone != null) {
            return $this->phone;
        } else {
            "Pas de téléphone";
        }
    }

    // Avoir le code client EBP
    public function getEBPCustomer()
    {
        if($this->EBP_customer != null) {
            return $this->EBP_customer;
        } else {
            return "Pas configuré";
        }
    }

    public function getFidelityPoint()
    {
        $fidelity = userFidelite::where('user_id', $this->id)->first();
        if($fidelity) {
            // L'utilisateur a bien de la fidélité
            return $fidelity->points;
        } else {
            return "0";
        }
    }
}
