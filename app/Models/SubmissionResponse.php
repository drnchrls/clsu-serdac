<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionResponse extends Model
{
    use HasFactory;

    protected $table = 'submission_responses';
    protected $primaryKey = 'submission_response_id';
    protected $fillable = [
        'submission_response_request_id',
        'submission_response_remark',
    ];
    
    public function submission(){
        return $this->belongsTo('\App\Models\SubmissionPublication','submission_response_request_id');
    }
}
