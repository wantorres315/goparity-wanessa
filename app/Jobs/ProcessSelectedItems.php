<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSelectedItems implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $selectedItems;
    public function __construct($selectedItems)
    {
        $this->selectedItems = $selectedItems;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->selectedItems as $itemId) {
            ProcessPayments::dispatch($itemId);
        }
    }
}
