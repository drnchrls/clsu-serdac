<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceResponse extends Model
{
    use HasFactory;
    protected $table = 'service_responses';
    protected $primaryKey = 'service_response_id';
    protected $fillable = [
        'service_response_request_id',
        'service_response_meeting_type',
        'service_response_meeting_place',
        'service_response_meeting_link',
        'service_response_meeting_time',
        'service_response_remark',
    ];

    public function service(){
        return $this->belongsTo('\App\Models\ServiceRequest','service_response_request_id');
    }
}
