<?php

namespace Domains\Secret\Services;

use Illuminate\Support\Facades\Crypt;

class SecretEncryptionService
{
    public function getDecryptedValue($value)
    {
        if (is_null($value)) {
            return null;
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return $value;
        }
    }

    /**
     * Méthode helper pour chiffrer une valeur
     */
    public function setEncryptedValue($value)
    {
        if (is_null($value)) {
            return null;
        }

        return Crypt::encryptString($value);
    }
}
