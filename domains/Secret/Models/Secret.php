<?php

namespace Domains\Secret\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Secret extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'secrets';

    protected $fillable = [
        'project',
        'service',
        'link',
        'username',
        'password',
        'is_active',
        'additional_information',
        'created_by',
    ];

    /**
     * Champs qui doivent être chiffrés
     */
    protected $encrypted = [
        'project',
        'service',
        'link',
        'username',
        'password',
        'additional_information'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sharedWith()
    {
        return $this->belongsToMany(User::class, 'secret_user');
    }

    /**
     * Accesseur pour le projet (déchiffrement automatique)
     */
    protected function project(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getDecryptedValue($value),
            set: fn($value) => $this->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le service (déchiffrement automatique)
     */
    protected function service(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getDecryptedValue($value),
            set: fn($value) => $this->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le lien (déchiffrement automatique)
     */
    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getDecryptedValue($value),
            set: fn($value) => $this->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le nom d'utilisateur (déchiffrement automatique)
     */
    protected function username(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getDecryptedValue($value),
            set: fn($value) => $this->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le mot de passe (déchiffrement automatique)
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getDecryptedValue($value),
            set: fn($value) => $this->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour les informations complémentaires (déchiffrement automatique)
     */
    protected function additionalInformation(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->getDecryptedValue($value),
            set: fn($value) => $this->setEncryptedValue($value),
        );
    }

    /**
     * Méthode helper pour déchiffrer une valeur
     */
    private function getDecryptedValue($value)
    {
        if (is_null($value)) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Si le déchiffrement échoue, retourner la valeur brute
            // (utile pour les données existantes non chiffrées)
            return $value;
        }
    }

    /**
     * Méthode helper pour chiffrer une valeur
     */
    private function setEncryptedValue($value)
    {
        if (is_null($value)) {
            return null;
        }

        return Crypt::encryptString($value);
    }
}
