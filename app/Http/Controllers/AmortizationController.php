<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPayments;
use App\Jobs\ProcessSelectedItems;
use Illuminate\Http\Request;
use App\Models\Amortization;
use App\Enums\StatusEnum;
use App\Http\Resources\AmortizationsResource;
class AmortizationController extends Controller
{
    public function get_all_amortizations($select=null){
        $search = $select;
        if(!$select){
            $amortizations = Amortization::with('project')->with('user')->with('payment')->where('state',StatusEnum::PENDING)
            ->orderBy('schedule_date', 'asc')
            ->paginate(500);
        }else{
            $amortizations = Amortization::with('project')->with('user')->with('payment')->where('state',StatusEnum::PENDING)
            ->where(function ($query) use ($search) {
                $query->whereHas('project', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('schedule_date', 'asc')->orderBy('project.wallet','asc')->paginate(500);
        }
        $amortizations->transform(function ($amortization) {
            if($amortization->project->wallet < 0){
                $amortization->status = StatusEnum::getLabels()[$amortization->state];
            }else{
                if($amortization->schedule_date < now()){
                    $amortization->status = StatusEnum::getLabels()[StatusEnum::LATE];
                }else{
                    $amortization->status = StatusEnum::getLabels()[$amortization->state];
                }
            }
            $amortization->payment_created_at= null;
            if(!empty($amortization->payment->created_at)){
                $dateOriginal = $amortization->payment->created_at;
                $dateFormat = date('Y-m-d', strtotime($dateOriginal));
                $amortization->payment_created_at = $dateFormat;
                
            }
            $amortization->url_project = '/projects/'.$amortization->project_id;
            return $amortization;
        });
       
        return AmortizationsResource::collection($amortizations);
    }

    public function paid($id)
    {
        try {
            $result = ProcessPayments::dispatch($id);
            return response()->json(['message' => 'Registrado na fila', 'result' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao registrar na fila', 'message' => $e->getMessage()], 500);
        }
    }
    public function getAllPaid($select=null){
        $search = $select;
        if(!$select){
            $amortizations = Amortization::with('project')->with('user')->with('payment')->where('state',StatusEnum::PAID)
            ->orderBy('schedule_date', 'asc')
            ->paginate(500);
        }else{
            $amortizations = Amortization::with('project')->with('user')->with('payment')->where('state',StatusEnum::PAID)
            ->where(function ($query) use ($search) {
                $query->whereHas('project', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('schedule_date', 'asc')->orderBy('project.wallet','asc')->paginate(500);
        }
        $amortizations->transform(function ($amortization) {
            if($amortization->project->wallet < 0){
                $amortization->status = StatusEnum::getLabels()[$amortization->state];
            }else{
                if($amortization->schedule_date < now()){
                    $amortization->status = StatusEnum::getLabels()[StatusEnum::LATE];
                }else{
                    $amortization->status = StatusEnum::getLabels()[$amortization->state];
                }
            }
            $amortization->payment_created_at= null;
            if(!empty($amortization->payment->created_at)){
                $dateOriginal = $amortization->payment->created_at;
                $dateFormat = date('Y-m-d', strtotime($dateOriginal));
                $amortization->payment_created_at = $dateFormat;
                
            }
            $amortization->url_project = '/projects/'.$amortization->project_id;
            return $amortization;
        });
       
        return AmortizationsResource::collection($amortizations);
    }
    public function paid_batch(Request $request){
        $selectedItems = $request->input('selectedItems', []);

        // Dispatch the job to the queue
        ProcessSelectedItems::dispatch($selectedItems);

        return response()->json(['message' => 'Items added to the queue successfully']);
    }
    
}
