<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\SubmissionPublication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserSubmissionController extends Controller
{
    //
    public function submissionPublication(){
        return view('dashboard.auth-user.submission_publication');
    }

    public function requests(){
        $id = Auth::guard('web')->user()->id;
        $pub = SubmissionPublication::where('submission_publication_user_id', $id)->latest()->get();
        $serv = ServiceRequest::where('service_request_user_id', $id)->latest()->get();
        return view('dashboard.auth-user.requests', ['submissionPublications'=>$pub, 'serviceRequests'=>$serv]);
    }

    public function storePublication(){
        request()->validate([
            'submission_publication_type' => 'required|string',
            'submission_publication_theme' => 'required|string',
            'submission_publication_title' => 'required|string|max:255',
            'submission_publication_author' => 'required|string|max:255',
            'submission_publication_description' => 'required|string',
            'submission_publication_contributor' => 'string|nullable',
            'submission_publication_publisher' => 'required|string',
            'submission_publication_doi' => 'string|nullable',
            'submission_publication_file' => 'required|file|mimes:pdf',
            'submission_publication_volume' => 'string|nullable',
            'submission_publication_issue' => 'string|nullable',
        ]);

        $file = request()->file('submission_publication_file');
        $fileName = $file->getClientOriginalName();

        $uploaded = Storage::disk('publication')->put($fileName, file_get_contents($file->getRealPath()));
        $url = Storage::disk('publication')->url($fileName);

        if($uploaded){
            SubmissionPublication::create([
                'submission_publication_user_id' => Auth::guard('web')->user()->id,
                'submission_publication_type' => request()->submission_publication_type,
                'submission_publication_theme' => request()->submission_publication_theme,
                'submission_publication_title' => request()->submission_publication_title,
                'submission_publication_author' => request()->submission_publication_author,
                'submission_publication_description' => request()->submission_publication_description,
                'submission_publication_contributor' => request()->submission_publication_contributor,
                'submission_publication_publisher' => request()->submission_publication_publisher,
                'submission_publication_issue' => request()->submission_publication_issue,
                'submission_publication_volume' => request()->submission_publication_volume,
                'submission_publication_doi' => request()->submission_publication_doi,
                'submission_publication_date' => request()->submission_publication_date,
                'submission_publication_file' => $fileName,
                'submission_publication_file_path' => $url,
            ]);
        }
        
        
        return redirect()->route('submission.publication')->with('success','Request Submitted Successfuly!');
    }

    public function serviceRequest(){
        return view('dashboard.auth-user.service-request');
    }
    public function storeServiceRequest(){
        
        request()->validate(
            [
            //    'service_request_fname'=>'required|string',
            //    'service_request_lname'=>'required|string',
            //    'service_request_email'=>'required|email',
            //    'service_request_contact'=>'required|string',
            //    'service_request_date'=>'required|date',
               'service_request_agency'=>'required|string',
               'service_request_client'=>'required|string',
               'service_request_specific_client'=>'string|nullable',
               'service_request_type'=>'required|string',
               'service_request_training_topic'=>'string|nullable',
               'service_request_analysis'=>'string|nullable',
               'service_request_specific_analysis'=>'string|nullable',
               'service_request_specific_technical'=>'string|nullable',
               'service_request_software'=>'string|nullable',
               'service_request_survey_target'=>'string|nullable',
               'service_request_survey_coverage'=>'string|nullable',
               'service_request_survey_description'=>'string|nullable',
               'service_request_agency_classification'=>'required|string',
               'service_request_reason'=>'required|string',
            ]);
        if(request()->service_request_client === 'Others'){
                $client = request()->service_request_specific_client;
               
        }else{
            $client  = request()->service_request_client;
        }

        if(request()->service_request_type === 'Training/Workshop'){
            $create = ServiceRequest::create(
                [
                    'service_request_user_id'=>Auth::guard('web')->user()->id,
                    'service_request_agency'=>request()->service_request_agency,
                    'service_request_agency_classification'=>request()->service_request_agency_classification,
                    'service_request_date'=>now(),
                    'service_request_client'=>$client,
                    'service_request_type'=>request()->service_request_type,
                    'service_request_training_topic'=>request()->service_request_training_topic,
                    'service_request_reason'=>request()->service_request_reason,
                ]
            );
        }else if(request()->service_request_type === 'Data Analytics'){
            if(request()->service_request_analysis === 'Others'){
                $type = request()->service_request_specific_analysis;
               
            }else{
                $type  = request()->service_request_analysis;
                
            }
            $create = ServiceRequest::create(
                [
                    'service_request_user_id'=>Auth::guard('web')->user()->id,
                    'service_request_agency'=>request()->service_request_agency,
                    'service_request_agency_classification'=>request()->service_request_agency_classification,
                    'service_request_date'=>now(),
                    'service_request_client'=>$client,
                    'service_request_type'=>request()->service_request_type,
                    'service_request_analysis'=>$type,
                    'service_request_reason'=>request()->service_request_reason,
                ]
            );
        }else if(request()->service_request_type === 'Technical Assistance/Consultancy'){
            if(request()->service_request_software === 'Others'){
                $software = request()->service_request_specific_technical;
            }
            else{
                $software =  request()->service_request_software;
            }
            $create = ServiceRequest::create(
                [
                    'service_request_user_id'=>Auth::guard('web')->user()->id,
                    'service_request_agency'=>request()->service_request_agency,
                    'service_request_agency_classification'=>request()->service_request_agency_classification,
                    'service_request_date'=>now(),
                    'service_request_client'=>$client,
                    'service_request_type'=>request()->service_request_type,
                    'service_request_reason'=>request()->service_request_reason,
                    'service_request_software'=>$software,
                ]
            );
        }else{
            $create = ServiceRequest::create(
                [
                    'service_request_user_id'=>Auth::guard('web')->user()->id,
                    'service_request_agency'=>request()->service_request_agency,
                    'service_request_agency_classification'=>request()->service_request_agency_classification,
                    'service_request_date'=>now(),
                    'service_request_client'=>$client,
                    'service_request_type'=>request()->service_request_type,
                    'service_request_survey_target'=>request()->service_request_survey_target,
                    'service_request_survey_coverage'=>request()->service_request_survey_coverage,
                    'service_request_reason'=>request()->service_request_reason,
                    'service_request_survey_description'=>request()->service_request_survey_description,
                ]
            );
        }

        // ServiceResponse::create([
        //     'service_response_request_id'=>$create->service_request_id,
        // ]);
        return redirect('/service-request')->with('success','Request Submitted Successfuly!');;
    }
}
