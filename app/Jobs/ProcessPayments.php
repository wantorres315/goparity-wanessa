<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Amortization;
use App\Models\Project;
use App\Enums\StatusEnum;
use App\Models\Payment;

class ProcessPayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $id)
    {
    
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       
        $amortization = Amortization::find($this->id);
        if ($amortization) {
            $project = Project::where('id', $amortization->project_id)->first();
            $project->update(array('wallet' => $project->wallet - $amortization->amount));
            $payment = Payment::where('amortization_id', $amortization->id)->first();
            if (empty($payment)) {
                if ($project) {
                    $calc = $project->wallet-$amortization->amount;
                    if( $calc > 0  && $calc > 0.000001) {
                        $project->wallet = $calc;
                        $project->save();
                        $amortization->state = StatusEnum::PAID;
                        $amortization->save();
    
                        $payment = new Payment();
                        $payment->user_id = $amortization->user_id;
                        $payment->amortization_id = $amortization->id;
                        $payment->amount = $amortization->amount;
                        $payment->state = StatusEnum::PAID;
                        $payment->save();
                    }else{
                        $amortization->state = StatusEnum::WITHOUT_MONEY;
                        $amortization->save();
                        $payment = new Payment();
                        $payment->user_id = $amortization->user_id;
                        $payment->amortization_id = $amortization->id;
                        $payment->amount = $amortization->amount;
                        $payment->state = StatusEnum::WITHOUT_MONEY;
                        $payment->reason = 'Project without money';
                        $payment->save();
                    }
                    
                }
            }
        } 
    }
}
