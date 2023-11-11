<?php

namespace App\Http\Controllers\Staff\Service;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\ServiceResponse;
use App\Notifications\ServiceResponseApproveNotification;
use App\Notifications\ServiceResponseRejectNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ServiceController extends Controller
{
    //
    public function serviceRequests(){
        $req = ServiceRequest::with('user')->where('service_request_status', 'Pending')->latest()->get();
        $res = ServiceResponse::with('service')->latest()->get();
        $resAp = ServiceRequest::with('user')->where('service_request_status', 'Approved')->get();
        $resRej = ServiceRequest::with('user')->where('service_request_status', 'Rejected')->get();
        return view('management.service-staff.service_requests', ['serviceRequests'=>$req,'serviceResponses'=>$res,'serviceResponseApproved'=>$resAp,'serviceResponseRejected'=>$resRej]);
    }

    public function approve(ServiceRequest $id){
        request()->validate([
            'service_response_meeting_type'=>'string|nullable',
            'service_response_meeting_time'=>'string|nullable',
            'service_response_meeting_link'=>'string|nullable',
            'service_response_meeting_place'=>'string|nullable',
            'service_response_remark'=>'required|string',
        ]);
        $id->service_request_status = 'Approved';
        $id->save();

        $subject = 'Service Request Approved';
        $req = $id->service_request_type;
        if($req === 'Training/Workshop'){
            $specific_req = $id->service_request_training_topic;
        }elseif($req === 'Data Analytics'){
            $specific_req = $id->service_request_analysis;
        }elseif($req === 'Technical Assistance'){
            $specific_req = $id->service_request_software;
        }else{
            $specific_req = $id->service_request_type;
        }
        
        $name = $id->user->fname;
        $email = $id->user->email;
        $type = request()->service_response_meeting_type;
        if($type === 'Online Meeting'){
            $linkPlace = request()->service_response_meeting_link;
        }else{
            $linkPlace = request()->service_response_meeting_place;
        }

        $time = request()->service_response_meeting_time;
        $remark = request()->service_response_remark;


        ServiceResponse::create([
            'service_response_request_id'=>$id->service_request_id,
            'service_response_meeting_type'=>$type,
            'service_response_meeting_time'=>$time,
            'service_response_meeting_place'=>request()->service_response_meeting_place,
            'service_response_meeting_link'=>request()->service_response_meeting_link,
            'service_response_remark'=>$remark,
        ]);

        Notification::route('mail', $email)->notify(new ServiceResponseApproveNotification($subject, $req, $specific_req, $name, $type, $linkPlace, $time, $remark));

        return response()->json(['success' => 'Approved!']);

    }
    public function reject(ServiceRequest $id){

        $id->service_request_status = 'Rejected';
        $id->save();

        $subject = 'Service Request Rejected';
        $req = $id->service_request_type;
        if($req === 'Training/Workshop'){
            $specific_req = $id->service_request_training_topic;
        }elseif($req === 'Data Analytics'){
            $specific_req = $id->service_request_analysis;
        }elseif($req === 'Technical Assistance'){
            $specific_req = $id->service_request_software;
        }else{
            $specific_req = $id->service_request_type;
        }
        
        $name = $id->user->fname;
        $email = $id->user->email;
        $remark = request()->service_response_remark;

        ServiceResponse::create([
            'service_response_request_id'=>$id->service_request_id,
            'service_response_remark'=>request()->service_response_remark,
        ]);
        Notification::route('mail', $email)->notify(new ServiceResponseRejectNotification($subject, $req, $specific_req, $name, $remark));
        
        return response()->json(['success' => 'Rejected!']);
    }
}
