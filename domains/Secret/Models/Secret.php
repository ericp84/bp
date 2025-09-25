<?php

namespace Domains\Secret\Models;

use Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Domains\Secret\Services\SecretEncryptionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Secret extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'secrets';
    protected $secretEncryptionService;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->secretEncryptionService = app(SecretEncryptionService::class);
    }

    protected $fillable = [
        'project',
        'service',
        'link',
        'username',
        'password',
        'is_active',
        'additional_information',
        'created_by',
        'updated_by',
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

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
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
            get: fn($value) => $this->secretEncryptionService->getDecryptedValue($value),
            set: fn($value) => $this->secretEncryptionService->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le service (déchiffrement automatique)
     */
    protected function service(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->secretEncryptionService->getDecryptedValue($value),
            set: fn($value) => $this->secretEncryptionService->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le lien (déchiffrement automatique)
     */
    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->secretEncryptionService->getDecryptedValue($value),
            set: fn($value) => $this->secretEncryptionService->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le nom d'utilisateur (déchiffrement automatique)
     */
    protected function username(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->secretEncryptionService->getDecryptedValue($value),
            set: fn($value) => $this->secretEncryptionService->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour le mot de passe (déchiffrement automatique)
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->secretEncryptionService->getDecryptedValue($value),
            set: fn($value) => $this->secretEncryptionService->setEncryptedValue($value),
        );
    }

    /**
     * Accesseur pour les informations complémentaires (déchiffrement automatique)
     */
    protected function additionalInformation(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->secretEncryptionService->getDecryptedValue($value),
            set: fn($value) => $this->secretEncryptionService->setEncryptedValue($value),
        );
    }
}
