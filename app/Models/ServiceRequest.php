<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $table = 'service_requests';
    protected $primaryKey = 'service_request_id';
    protected $fillable = [
        'service_request_user_id',
        'service_request_date',
        'service_request_agency',
        'service_request_client',
        'service_request_agency_classification',
        'service_request_type',
        'service_request_training_topic',
        'service_request_analysis',
        'service_request_software',
        'service_request_survey_description',
        'service_request_reason',
        'service_request_status',
        'service_request_survey_target',
        'service_request_survey_coverage',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'service_request_user_id');
    }
}
