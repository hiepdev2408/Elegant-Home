<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Variant;
use App\Notifications\LowStock;

class VariantObserver
{
    /**
     * Handle the Variant "created" event.
     */
    public function created(Variant $variant): void
    {
        //
    }

    /**
     * Handle the Variant "updated" event.
     */
    public function updated(Variant $variant)
    {

    }

    /**
     * Handle the Variant "deleted" event.
     */
    public function deleted(Variant $variant): void
    {
        //
    }

    /**
     * Handle the Variant "restored" event.
     */
    public function restored(Variant $variant): void
    {
        //
    }

    /**
     * Handle the Variant "force deleted" event.
     */
    public function forceDeleted(Variant $variant): void
    {
        //
    }
}
