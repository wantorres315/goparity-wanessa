<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\User;
use App\Models\Payment;

class Amortization extends Model
{
    use HasFactory;

    public function project(){
        return $this->hasOne(Project::class, "id","project_id");
    }
    public function user(){
        return $this->hasOne(User::class, "id","user_id");
    }
    public function payment(){
        return $this->hasOne(Payment::class, "amortization_id", "id");
    }
}
