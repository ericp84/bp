<?php

namespace App\Services;

use Domains\Secret\Models\Secret;
use Domains\Auth\Models\User;

class SecretAccessService
{
    public function canAccessSecret(User $user, Secret $secret): bool
    {
        return ($secret->created_by == $user->id) ||
            $secret->sharedWith->contains('id', $user->id);
    }

    public function canAccessSecretById(User $user, int $secretId): bool
    {
        $secret = Secret::find($secretId);

        if (!$secret) {
            return false;
        }

        return $this->canAccessSecret($user, $secret);
    }

    public function userHasAccessToAnySecret(User $user): bool
    {
        return Secret::where(function ($query) use ($user) {
            $query->where('created_by', $user->id)
                ->orWhereHas('sharedWith', function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                });
        })->exists();
    }

    public function ensureAccess(User $user, int $secretId): void
    {
        if (!$this->canAccessSecretById($user, $secretId)) {
            abort(403, '🚫 Vous n\'avez pas accès à ce secret.');
        }
    }
}
