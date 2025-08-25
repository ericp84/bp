<?php

namespace Domains\Secret\Observers;

use Domains\Secret\Models\Secret;

class SecretObserver
{
    /**
     * Handle the Secret "created" event.
     */
    public function created(Secret $secret): void
    {
        $secret->sharedWith()->attach($secret->created_by);
    }

    /**
     * Handle the Secret "updated" event.
     */
    public function updated(Secret $secret): void
    {
        //
    }

    /**
     * Handle the Secret "deleted" event.
     */
    public function deleted(Secret $secret): void
    {
        //
    }

    /**
     * Handle the Secret "restored" event.
     */
    public function restored(Secret $secret): void
    {
        //
    }

    /**
     * Handle the Secret "force deleted" event.
     */
    public function forceDeleted(Secret $secret): void
    {
        //
    }
}
