<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\DatasetViewCount;
use App\Models\DownloadDataset;
use App\Models\DownloadPublication;
use App\Models\SubmissionPublication;
use App\Models\PrivUser;
use App\Models\Publication;
use App\Models\PublicationViewCount;
use App\Models\ServiceRequest;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

use TCPDF;

class StaffController extends Controller
{

    
    public function editProfile(Staff $id){
        return view('management.layouts.private_profile',
            array('current_user' => Auth::guard('staff')->user(),
            $id) 
        );
    }


    public function updateProfile(Staff $id)
    {

        $data = request()->validate([
            'staff_fname' => ['required','string', 'max:255'],
            'staff_lname' => ['required','string', 'max:255'],
            'staff_contact' => ['required','string'],
        ],[],
        [
            'staff_fname' => 'first name',
            'staff_lname' => 'last name',
            'staff_contact' => 'contact'
        ]);

        // Update user
        $id->update($data);
        
        return redirect()->back()
            ->with('updated', 'Updated successfully');
    }

    public function updatePassword()
    {
            request()->validate([
                'old_staff_password' => 'required',
                'new_staff_password' => 'required|min:8|confirmed',
                // 'new_staff_password_confirmation' => 'required|min:8|same:new_staff_password',
            ],[],[
                'new_staff_password' => 'password',
            ]);
    
    
            // Verify old password
            if(!Hash::check(request()->old_staff_password, auth()->user()->staff_password)){
                return back()->with("error", "Old password doesn't match!");
            }
    
    
            // Update the new password
            Staff::where('staff_id',auth()->user()->staff_id)->update([
                'staff_password' => Hash::make(request()->new_staff_password)
            ]);
    
            return back()->with("success", "Password changed successfully!");
    }

    public function analyticsAdmin(){
        
        $currentYear = Carbon::now()->year;
        $month = Carbon::now()->format('F');
        $currentMonth = Carbon::now()->month;

        $daysInCurrentMonth = date('t', strtotime($currentYear . '-' . $currentMonth));
        $labels = range(1, $daysInCurrentMonth);

/////////////////////////// USER DEMOGRAPHICS //////////////////////////////// 
        $usersGenders = User::selectRaw('gender, COUNT(*) as count')->groupBy('gender')->get();
        $usersLabelGender = [
            'Male',
            'Female',
            'Prefer not to say',
            'Prefer to self-describe',
        ];
        $usersDataGender = array_fill(0, count($usersLabelGender), 0);
        foreach ($usersGenders as $usersGender) {
            $searchString = $usersGender->gender;
            $foundIndex = array_search($searchString, $usersLabelGender);
            if ($foundIndex !== false) {
                $usersDataGender[$foundIndex] = $usersGender->count;
            }
        }

        $usersELs = User::selectRaw('educational_level, COUNT(*) as count')->groupBy('educational_level')->get();
        $usersLabelEL = [
            'No schooling',
            'Elementary',
            'High School',
            'Vocational',
            'College',
            'Postgraduate',
        ];
        $usersDataEL = array_fill(0, count($usersLabelEL), 0);
        foreach ($usersELs as $usersEL) {
            $searchString = $usersEL->educational_level;
            $foundIndex = array_search($searchString, $usersLabelEL);
            if ($foundIndex !== false) {
                $usersDataEL[$foundIndex] = $usersEL->count;
            }
        }


        $usersOccs = User::selectRaw('occupation, COUNT(*) as count')->groupBy('occupation')->get();
        $usersLabelOcc = [
            'Student',
            'Employed (Full-time)',
            'Employed (Part-time)',
            'Self-employed',
            'Homemake',
            'Retired',
            'Others',
        ];
        $usersDataOcc = array_fill(0, count($usersLabelOcc), 0);
        foreach ($usersOccs as $usersOcc) {
            $searchString = $usersOcc->occupation;
            $foundIndex = array_search($searchString, $usersLabelOcc);
            if ($foundIndex !== false) {
                $usersDataOcc[$foundIndex] = $usersOcc->count;
            }
        }

        $ageBrackets = [
            'Under 18' => [0, 17],
            '18-24' => [18, 24],
            '25-34' => [25, 34],
            '35-44' => [35, 44],
            '45-54' => [45, 54],
            '55-64' => [55, 64],
            '65 and Over' => [65, 200], // Set a maximum value for the upper age limit
        ];
        function getAgeBracket($age, $ageBrackets) {
            foreach ($ageBrackets as $label => $range) {
                list($min, $max) = $range;
                if ($age >= $min && $age <= $max) {
                    return $label;
                }
            }
        
            // If the age doesn't fall into any defined bracket, you can handle it as needed.
            return 'Unknown';
        }
        $ageBracketCounts = array_fill_keys(array_keys($ageBrackets), 0);
        $usersAge = User::select('age')->get();

        foreach ($usersAge as $user) {
            $age = $user->age;
            $ageBracket = getAgeBracket($age, $ageBrackets);
            $ageBracketCounts[$ageBracket] += 1;
        }
        
        $usersAgeData = [
            'labels' => array_keys($ageBracketCounts),
            'data' => array_values($ageBracketCounts),
        ];


        $monthlyAccounts = User::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(created_at) as day')
        ->groupBy( 'day')
        ->get();

        $monthlyAccountData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monthlyAccounts as $monthlyAccount) {
            $dayAC = $monthlyAccount->day;
            $monthlyAccountData[$dayAC - 1] = $monthlyAccount->count;
        }

        $yearlyAccounts = User::whereYear('created_at', $currentYear)
        ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy( 'month')
        ->get();

        $yearlyAccountData = array_fill(0, 12, 0);
        foreach ($yearlyAccounts as $yearlyAccount) {
            $monthAC = $yearlyAccount->month;
            $yearlyAccountData[$monthAC - 1] = $yearlyAccount->count;
        }
/////////////////////////// USER DEMOGRAPHICS (END) ////////////////////////////////  

/////////////////////////// DOWNLOADS //////////////////////////////// 

        $monthlyPubReasonDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();

        $reasonDownloadLabel = [
            'in preparing school curriculum/course',
            'in preparing school reports/papers/theses',
            'in preparing news and features articles/columns/editorials',
            'in writing research studies/projects',
            'in formulating policies, laws, or ordinances',
            'in developing programs, projects, or services',
            'Others',
        ];

        $monthlyPubReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($monthlyPubReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $monthlyPubReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }

        $monthlyDatReasonDownloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();

        $monthlyDatReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($monthlyDatReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $monthlyDatReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }

        // 
        $yearlyPubReasonDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();


        $yearlyPubReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($yearlyPubReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $yearlyPubReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }

        $yearlyDatReasonDownloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();

        $yearlyDatReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($yearlyDatReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $yearlyDatReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }


        $monthlyPublicationDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(download_date) as day')
        ->groupBy( 'day')
        ->get();

        $monthlyPublicationData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monthlyPublicationDownloads as $monthlyPublicationDownload) {
            $dayPB = $monthlyPublicationDownload->day;
            $monthlyPublicationData[$dayPB - 1] = $monthlyPublicationDownload->count;
        }

        $monthlyDatasetDowloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(download_date) as day')
        ->groupBy('day')
        ->get();

        $monthlyDatasetData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monthlyDatasetDowloads as $datasetDownload) {
            $dayDT = $datasetDownload->day;
            $monthlyDatasetData[$dayDT - 1] = $datasetDownload->count;
        }


        $yearlyPublicationDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, MONTH(download_date) as month')
        ->groupBy( 'month')
        ->get();

        $yearlyPublicationData = array_fill(0, 12, 0);
        foreach ($yearlyPublicationDownloads as $yearlyPublicationDownload) {
            $monthPB = $yearlyPublicationDownload->month;
            $yearlyPublicationData[$monthPB - 1] = $yearlyPublicationDownload->count;
        }

        $yearlyDatasetDownloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, MONTH(download_date) as month')
        ->groupBy( 'month')
        ->get();

        $yearlyDatasetData = array_fill(0, 12, 0);
        foreach ($yearlyDatasetDownloads as $yearlyDatasetDownload) {
            $monthDT = $yearlyDatasetDownload->month;
            $yearlyDatasetData[$monthDT - 1] = $yearlyDatasetDownload->count;
        }


        $monthlyTopDownloadPublications = DownloadPublication::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->select('download_publication_id')
        ->selectRaw('COUNT(download_publication_id) as count, download_publication_title, download_publication_author')
        ->groupBy('download_publication_id', 'download_publication_title', 'download_publication_author')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

        $monthlyTopViewPublications = PublicationViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->select('publication_view_count_pub_id')
        ->selectRaw('COUNT(publication_view_count_pub_id) as count')
        ->groupBy('publication_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

        $monthlyTopDownloadDatasets = DownloadDataset::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->select('download_dataset_id')
        ->selectRaw('COUNT(download_dataset_id) as count, download_dataset_title, download_dataset_author')
        ->groupBy('download_dataset_id', 'download_dataset_title', 'download_dataset_author')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

        $monthlyTopViewDatasets = DatasetViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->select('dataset_view_count_pub_id')
        ->selectRaw('COUNT(dataset_view_count_pub_id) as count')
        ->groupBy('dataset_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

        $yearlyTopDownloadPublications = DownloadPublication::whereYear('download_date', $currentYear)
        ->select('download_publication_id')
        ->selectRaw('COUNT(download_publication_id) as count, download_publication_title, download_publication_author')
        ->groupBy('download_publication_id', 'download_publication_title', 'download_publication_author')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

        $yearlyTopViewPublications = PublicationViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->select('publication_view_count_pub_id')
        ->selectRaw('COUNT(publication_view_count_pub_id) as count')
        ->groupBy('publication_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

        $yearlyTopDownloadDatasets = DownloadDataset::whereYear('download_date', $currentYear)
        ->select('download_dataset_id')
        ->selectRaw('COUNT(download_dataset_id) as count, download_dataset_title, download_dataset_author')
        ->groupBy('download_dataset_id', 'download_dataset_title', 'download_dataset_author')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

        $yearlyTopViewDatasets = DatasetViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->select('dataset_view_count_pub_id')
        ->selectRaw('COUNT(dataset_view_count_pub_id) as count')
        ->groupBy('dataset_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->limit(10)
        ->get();

/////////////////////////// DOWNLOADS (END) //////////////////////////////// 

/////////////////////////// REQUESTS  //////////////////////////////// 
        $monyhlySubmissionPublications = SubmissionPublication::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(created_at) as day')
        ->groupBy( 'day')
        ->get();
        $monthlySubmissionData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monyhlySubmissionPublications as $monyhlySubmissionPublication) {
            $daySP = $monyhlySubmissionPublication->day;
            $monthlySubmissionData[$daySP - 1] = $monyhlySubmissionPublication->count;
        }

        $monthlyServiceRequests = ServiceRequest::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(created_at) as day')
        ->groupBy( 'day')
        ->get();
        $monthlyRequestData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monthlyServiceRequests as $monthlyServiceRequest) {
            $daySR = $monthlyServiceRequest->day;
            $monthlyRequestData[$daySR - 1] = $monthlyServiceRequest->count;
        }

        $yearlySubmissionPublications = SubmissionPublication::
        whereYear('created_at', $currentYear)
        // ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->get();

        $yearlySubmissionData = array_fill(0, 12, 0);

        foreach ($yearlySubmissionPublications as $yearlySubmissionPublication) { // Change variable name here
            $monthPB = $yearlySubmissionPublication->month;
            $yearlySubmissionData[$monthPB - 1] = $yearlySubmissionPublication->count;
        }

        $yearlyServiceRequests = ServiceRequest::
        whereYear('created_at', $currentYear)
        // ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->get();

        $yearlyRequestsData = array_fill(0, 12, 0);

        foreach ($yearlyServiceRequests as $yearlyServiceRequest) { // Change variable name here
            $monthPB = $yearlyServiceRequest->month;
            $yearlyRequestsData[$monthPB - 1] = $yearlyServiceRequest->count;
        }

        $monthlyPublicationTypeRequestsStatus = SubmissionPublication::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        // ->where('submission_publication_status', 'Pending')
        ->select('submission_publication_type')
        ->selectRaw('SUM(CASE WHEN submission_publication_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN submission_publication_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN submission_publication_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     submission_publication_type')
        ->groupBy('submission_publication_type')
        ->get();

        $monthlyServiceTypeRequestsStatus = ServiceRequest::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        // ->where('submission_publication_status', 'Pending')
        ->select('service_request_type')
        ->selectRaw('SUM(CASE WHEN service_request_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN service_request_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN service_request_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     service_request_type')
        ->groupBy('service_request_type')
        ->get();


        $monthlyPublicationTypeRequests = SubmissionPublication::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('submission_publication_type, COUNT(*) as count')
        ->groupBy('submission_publication_type')
        ->get();

        $publicationTypeRequestsLabel = [
            'Journal/Journal Article',
            'Book',
            'Technical Report/Research Paper',
            'Unclassified/Others',
        ];
        $monthlyPublicationTypeRequestsData = array_fill(0, count($publicationTypeRequestsLabel), 0);
        foreach ($monthlyPublicationTypeRequests as $monthlyPublicationTypeRequest) {
            $searchString = $monthlyPublicationTypeRequest->submission_publication_type;
            $foundIndex = array_search($searchString, $publicationTypeRequestsLabel);
            if ($foundIndex !== false) {
                $monthlyPublicationTypeRequestsData[$foundIndex] = $monthlyPublicationTypeRequest->count;
            }
        }

        $monthlyServiceTypeRequests = ServiceRequest::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('service_request_type, COUNT(*) as count')
        ->groupBy('service_request_type')
        ->get();

        $serviceTypeRequestsLabel = [
            'Training/Workshop',
            'Technical Assistance/Consultancy',
            'Data Analytics',
            'Survey Services',
        ];
        $monthlyServiceTypeRequestsData = array_fill(0, count($serviceTypeRequestsLabel), 0);
        foreach ($monthlyServiceTypeRequests as $monthlyServiceTypeRequest) {
            $searchString = $monthlyServiceTypeRequest->service_request_type;
            $foundIndex = array_search($searchString, $serviceTypeRequestsLabel);
            if ($foundIndex !== false) {
                $monthlyServiceTypeRequestsData[$foundIndex] = $monthlyServiceTypeRequest->count;
            }
        }


        $yearlyPublicationTypeRequestsStatus = SubmissionPublication::whereYear('created_at', $currentYear)
        // ->where('submission_publication_status', 'Pending')
        ->select('submission_publication_type')
        ->selectRaw('SUM(CASE WHEN submission_publication_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN submission_publication_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN submission_publication_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     submission_publication_type')
        ->groupBy('submission_publication_type')
        ->get();

        $yearlyServiceTypeRequestsStatus = ServiceRequest::whereYear('created_at', $currentYear)
        // ->where('submission_publication_status', 'Pending')
        ->select('service_request_type')
        ->selectRaw('SUM(CASE WHEN service_request_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN service_request_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN service_request_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     service_request_type')
        ->groupBy('service_request_type')
        ->get();

        $yearlyPublicationTypeRequests = SubmissionPublication::whereYear('created_at', $currentYear)
        ->selectRaw('submission_publication_type, COUNT(*) as count')
        ->groupBy('submission_publication_type')
        ->get();

        $yearlyPublicationTypeRequestsData = array_fill(0, count($publicationTypeRequestsLabel), 0);
        foreach ($yearlyPublicationTypeRequests as $yearlyPublicationTypeRequest) {
            $searchString = $yearlyPublicationTypeRequest->submission_publication_type;
            $foundIndex = array_search($searchString, $publicationTypeRequestsLabel);
            if ($foundIndex !== false) {
                $yearlyPublicationTypeRequestsData[$foundIndex] = $yearlyPublicationTypeRequest->count;
            }
        }

        $yearlyServiceTypeRequests = ServiceRequest::whereYear('created_at', $currentYear)
        ->selectRaw('service_request_type, COUNT(*) as count')
        ->groupBy('service_request_type')
        ->get();

        $yearlyServiceTypeRequestsData = array_fill(0, count($serviceTypeRequestsLabel), 0);
        foreach ($yearlyServiceTypeRequests as $yearlyServiceTypeRequest) {
            $searchString = $yearlyServiceTypeRequest->service_request_type;
            $foundIndex = array_search($searchString, $serviceTypeRequestsLabel);
            if ($foundIndex !== false) {
                $yearlyServiceTypeRequestsData[$foundIndex] = $yearlyServiceTypeRequest->count;
            }
        }
/////////////////////////// REQUESTS (END)  ////////////////////////////////

        $publicationRequestsPending = SubmissionPublication::where('submission_publication_status', 'Pending')->count();
        $serviceRequestsPending = ServiceRequest::where('service_request_status', 'Pending')->count();
        $publicationTotal = Publication::count();
        $datasetTotal = Dataset::count();
        $userTotal = User::count();
        $staffTotal = Staff::count();

        return view('management.admin.analytics', 
            compact( 
                'labels',
                'monthlyPublicationData',
                'monthlyDatasetData', 
                'monthlySubmissionData', 
                'monthlyRequestData', 
                'yearlySubmissionData', 
                'yearlyRequestsData', 
                'yearlyPublicationData', 
                'yearlyDatasetData',
                'usersDataGender', 
                'usersLabelGender', 
                'usersDataEL', 
                'usersLabelEL',
                'usersDataOcc', 
                'usersLabelOcc',
                'usersAgeData',
                'monthlyPubReasonDownloadData',
                'monthlyDatReasonDownloadData',
                'yearlyPubReasonDownloadData',
                'yearlyDatReasonDownloadData',
                'reasonDownloadLabel',
                'monthlyTopDownloadPublications',
                'monthlyTopViewPublications',
                'monthlyTopDownloadDatasets',
                'monthlyTopViewDatasets',
                'yearlyTopDownloadPublications',
                'yearlyTopViewPublications',
                'yearlyTopDownloadDatasets',
                'yearlyTopViewDatasets',
                'publicationTypeRequestsLabel',
                'serviceTypeRequestsLabel',
                'monthlyPublicationTypeRequestsData',
                'monthlyServiceTypeRequestsData',
                'yearlyPublicationTypeRequestsData',
                'yearlyServiceTypeRequestsData',
                'monthlyPublicationTypeRequestsStatus',
                'monthlyServiceTypeRequestsStatus',
                'yearlyPublicationTypeRequestsStatus',
                'yearlyServiceTypeRequestsStatus',
                'monthlyAccountData',
                'yearlyAccountData',
                'publicationRequestsPending',
                'serviceRequestsPending',
                'publicationTotal',
                'datasetTotal',
                'userTotal',
                'staffTotal',
            )
        );
    }

    public function analyticsLibrary(){
        

        $currentYear = Carbon::now()->year;
        $month = Carbon::now()->format('F');
        $currentMonth = Carbon::now()->month;
        $years = Publication::selectRaw('YEAR(created_at) as year')
        ->groupBy( 'year')
        ->get();

        $daysInCurrentMonth = date('t', strtotime($currentYear . '-' . $currentMonth));
        $labels = range(1, $daysInCurrentMonth);


/////////////////////////// DOWNLOADS //////////////////////////////// 

        $monthlyPubReasonDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();

        $reasonDownloadLabel = [
            'in preparing school curriculum/course',
            'in preparing school reports/papers/theses',
            'in preparing news and features articles/columns/editorials',
            'in writing research studies/projects',
            'in formulating policies, laws, or ordinances',
            'in developing programs, projects, or services',
            'Others',
        ];

        $monthlyPubReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($monthlyPubReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $monthlyPubReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }

        $monthlyDatReasonDownloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();

        $monthlyDatReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($monthlyDatReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $monthlyDatReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }

        // 
        $yearlyPubReasonDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();


        $yearlyPubReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($yearlyPubReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $yearlyPubReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }

        $yearlyDatReasonDownloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, download_reason')
        ->groupBy( 'download_reason')
        ->get();

        $yearlyDatReasonDownloadData = array_fill(0, count($reasonDownloadLabel), 0);
        foreach ($yearlyDatReasonDownloads as $reasonDownload) {
            $searchString = $reasonDownload->download_reason;
            $foundIndex = array_search($searchString, $reasonDownloadLabel);
            if ($foundIndex !== false) {
                $yearlyDatReasonDownloadData[$foundIndex] = $reasonDownload->count;
            }
        }


        $monthlyPublicationDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(download_date) as day')
        ->groupBy( 'day')
        ->get();

        $monthlyPublicationData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monthlyPublicationDownloads as $monthlyPublicationDownload) {
            $dayPB = $monthlyPublicationDownload->day;
            $monthlyPublicationData[$dayPB - 1] = $monthlyPublicationDownload->count;
        }

        $monthlyDatasetDowloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(download_date) as day')
        ->groupBy('day')
        ->get();

        $monthlyDatasetData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monthlyDatasetDowloads as $datasetDownload) {
            $dayDT = $datasetDownload->day;
            $monthlyDatasetData[$dayDT - 1] = $datasetDownload->count;
        }


        $yearlyPublicationDownloads = DownloadPublication::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, MONTH(download_date) as month')
        ->groupBy( 'month')
        ->get();

        $yearlyPublicationData = array_fill(0, 12, 0);
        foreach ($yearlyPublicationDownloads as $yearlyPublicationDownload) {
            $monthPB = $yearlyPublicationDownload->month;
            $yearlyPublicationData[$monthPB - 1] = $yearlyPublicationDownload->count;
        }

        $yearlyDatasetDownloads = DownloadDataset::whereYear('download_date', $currentYear)
        ->selectRaw('COUNT(*) as count, MONTH(download_date) as month')
        ->groupBy( 'month')
        ->get();

        $yearlyDatasetData = array_fill(0, 12, 0);
        foreach ($yearlyDatasetDownloads as $yearlyDatasetDownload) {
            $monthDT = $yearlyDatasetDownload->month;
            $yearlyDatasetData[$monthDT - 1] = $yearlyDatasetDownload->count;
        }


        $monthlyTopDownloadPublications = DownloadPublication::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->select('download_publication_id')
        ->selectRaw('COUNT(download_publication_id) as count, download_publication_title, download_publication_author')
        ->groupBy('download_publication_id', 'download_publication_title', 'download_publication_author')
        ->orderBy('count', 'desc')
        ->get();

        $monthlyTopViewPublications = PublicationViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->select('publication_view_count_pub_id')
        ->selectRaw('COUNT(publication_view_count_pub_id) as count')
        ->groupBy('publication_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->get();

        $monthlyTopDownloadDatasets = DownloadDataset::whereYear('download_date', $currentYear)
        ->whereMonth('download_date', $currentMonth)
        ->select('download_dataset_id')
        ->selectRaw('COUNT(download_dataset_id) as count, download_dataset_title, download_dataset_author')
        ->groupBy('download_dataset_id', 'download_dataset_title', 'download_dataset_author')
        ->orderBy('count', 'desc')
        ->get();

        $monthlyTopViewDatasets = DatasetViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->select('dataset_view_count_pub_id')
        ->selectRaw('COUNT(dataset_view_count_pub_id) as count')
        ->groupBy('dataset_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->get();

        $yearlyTopDownloadPublications = DownloadPublication::whereYear('download_date', $currentYear)
        ->select('download_publication_id')
        ->selectRaw('COUNT(download_publication_id) as count, download_publication_title, download_publication_author')
        ->groupBy('download_publication_id', 'download_publication_title', 'download_publication_author')
        ->orderBy('count', 'desc')
        ->get();

        $yearlyTopViewPublications = PublicationViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->select('publication_view_count_pub_id')
        ->selectRaw('COUNT(publication_view_count_pub_id) as count')
        ->groupBy('publication_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->get();

        $yearlyTopDownloadDatasets = DownloadDataset::whereYear('download_date', $currentYear)
        ->select('download_dataset_id')
        ->selectRaw('COUNT(download_dataset_id) as count, download_dataset_title, download_dataset_author')
        ->groupBy('download_dataset_id', 'download_dataset_title', 'download_dataset_author')
        ->orderBy('count', 'desc')
        ->get();

        $yearlyTopViewDatasets = DatasetViewCount::with('publication')
        ->whereYear('created_at', $currentYear)
        ->select('dataset_view_count_pub_id')
        ->selectRaw('COUNT(dataset_view_count_pub_id) as count')
        ->groupBy('dataset_view_count_pub_id')
        ->orderBy('count', 'desc')
        ->get();

/////////////////////////// DOWNLOADS (END) //////////////////////////////// 

/////////////////////////// REQUESTS  //////////////////////////////// 
        $monyhlySubmissionPublications = SubmissionPublication::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(created_at) as day')
        ->groupBy( 'day')
        ->get();
        $monthlySubmissionData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monyhlySubmissionPublications as $monyhlySubmissionPublication) {
            $daySP = $monyhlySubmissionPublication->day;
            $monthlySubmissionData[$daySP - 1] = $monyhlySubmissionPublication->count;
        }


        $yearlySubmissionPublications = SubmissionPublication::
        whereYear('created_at', $currentYear)
        // ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->get();

        $yearlySubmissionData = array_fill(0, 12, 0);

        foreach ($yearlySubmissionPublications as $yearlySubmissionPublication) { // Change variable name here
            $monthPB = $yearlySubmissionPublication->month;
            $yearlySubmissionData[$monthPB - 1] = $yearlySubmissionPublication->count;
        }

        $monthlyPublicationTypeRequestsStatus = SubmissionPublication::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        // ->where('submission_publication_status', 'Pending')
        ->select('submission_publication_type')
        ->selectRaw('SUM(CASE WHEN submission_publication_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN submission_publication_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN submission_publication_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     submission_publication_type')
        ->groupBy('submission_publication_type')
        ->get();


        $monthlyPublicationTypeRequests = SubmissionPublication::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('submission_publication_type, COUNT(*) as count')
        ->groupBy('submission_publication_type')
        ->get();

        $publicationTypeRequestsLabel = [
            'Journal/Journal Article',
            'Book',
            'Technical Report/Research Paper',
            'Unclassified/Others',
        ];
        $monthlyPublicationTypeRequestsData = array_fill(0, count($publicationTypeRequestsLabel), 0);
        foreach ($monthlyPublicationTypeRequests as $monthlyPublicationTypeRequest) {
            $searchString = $monthlyPublicationTypeRequest->submission_publication_type;
            $foundIndex = array_search($searchString, $publicationTypeRequestsLabel);
            if ($foundIndex !== false) {
                $monthlyPublicationTypeRequestsData[$foundIndex] = $monthlyPublicationTypeRequest->count;
            }
        }

        $yearlyPublicationTypeRequestsStatus = SubmissionPublication::whereYear('created_at', $currentYear)
        // ->where('submission_publication_status', 'Pending')
        ->select('submission_publication_type')
        ->selectRaw('SUM(CASE WHEN submission_publication_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN submission_publication_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN submission_publication_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     submission_publication_type')
        ->groupBy('submission_publication_type')
        ->get();

        $yearlyPublicationTypeRequests = SubmissionPublication::whereYear('created_at', $currentYear)
        ->selectRaw('submission_publication_type, COUNT(*) as count')
        ->groupBy('submission_publication_type')
        ->get();

        $yearlyPublicationTypeRequestsData = array_fill(0, count($publicationTypeRequestsLabel), 0);
        foreach ($yearlyPublicationTypeRequests as $yearlyPublicationTypeRequest) {
            $searchString = $yearlyPublicationTypeRequest->submission_publication_type;
            $foundIndex = array_search($searchString, $publicationTypeRequestsLabel);
            if ($foundIndex !== false) {
                $yearlyPublicationTypeRequestsData[$foundIndex] = $yearlyPublicationTypeRequest->count;
            }
        }

/////////////////////////// REQUESTS (END)  ////////////////////////////////

        return view('management.e-library.analytics', 
            compact(
                // 'years', 
                'labels',
                'monthlyPublicationData',
                'monthlyDatasetData', 
                'monthlySubmissionData', 
                'yearlySubmissionData', 
                'yearlyPublicationData', 
                'yearlyDatasetData',
                'monthlyPubReasonDownloadData',
                'monthlyDatReasonDownloadData',
                'yearlyPubReasonDownloadData',
                'yearlyDatReasonDownloadData',
                'reasonDownloadLabel',
                'monthlyTopDownloadPublications',
                'monthlyTopViewPublications',
                'monthlyTopDownloadDatasets',
                'monthlyTopViewDatasets',
                'yearlyTopDownloadPublications',
                'yearlyTopViewPublications',
                'yearlyTopDownloadDatasets',
                'yearlyTopViewDatasets',
                'monthlyPublicationTypeRequestsData',
                'yearlyPublicationTypeRequestsData',
                'monthlyPublicationTypeRequestsStatus',
                'yearlyPublicationTypeRequestsStatus',
                'publicationTypeRequestsLabel',

            )
        );
    }

    public function analyticsService(){
    
        $currentYear = Carbon::now()->year;
        $month = Carbon::now()->format('F');
        $currentMonth = Carbon::now()->month;

        $daysInCurrentMonth = date('t', strtotime($currentYear . '-' . $currentMonth));
        $labels = range(1, $daysInCurrentMonth);

/////////////////////////// REQUESTS  //////////////////////////////// 

        $monthlyServiceRequests = ServiceRequest::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('COUNT(*) as count, DAY(created_at) as day')
        ->groupBy( 'day')
        ->get();
        $monthlyRequestData = array_fill(0, $daysInCurrentMonth, 0);
        foreach ($monthlyServiceRequests as $monthlyServiceRequest) {
            $daySR = $monthlyServiceRequest->day;
            $monthlyRequestData[$daySR - 1] = $monthlyServiceRequest->count;
        }

        $yearlyServiceRequests = ServiceRequest::
        whereYear('created_at', $currentYear)
        // ->whereMonth('download_date', $currentMonth)
        ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->get();

        $yearlyRequestsData = array_fill(0, 12, 0);

        foreach ($yearlyServiceRequests as $yearlyServiceRequest) { // Change variable name here
            $monthPB = $yearlyServiceRequest->month;
            $yearlyRequestsData[$monthPB - 1] = $yearlyServiceRequest->count;
        }


        $monthlyServiceTypeRequestsStatus = ServiceRequest::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        // ->where('submission_publication_status', 'Pending')
        ->select('service_request_type')
        ->selectRaw('SUM(CASE WHEN service_request_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN service_request_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN service_request_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     service_request_type')
        ->groupBy('service_request_type')
        ->get();

        $monthlyServiceTypeRequests = ServiceRequest::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->selectRaw('service_request_type, COUNT(*) as count')
        ->groupBy('service_request_type')
        ->get();

        $serviceTypeRequestsLabel = [
            'Training/Workshop',
            'Technical Assistance/Consultancy',
            'Data Analytics',
            'Survey Services',
        ];
        $monthlyServiceTypeRequestsData = array_fill(0, count($serviceTypeRequestsLabel), 0);
        foreach ($monthlyServiceTypeRequests as $monthlyServiceTypeRequest) {
            $searchString = $monthlyServiceTypeRequest->service_request_type;
            $foundIndex = array_search($searchString, $serviceTypeRequestsLabel);
            if ($foundIndex !== false) {
                $monthlyServiceTypeRequestsData[$foundIndex] = $monthlyServiceTypeRequest->count;
            }
        }

        $yearlyServiceTypeRequestsStatus = ServiceRequest::whereYear('created_at', $currentYear)
        // ->where('submission_publication_status', 'Pending')
        ->select('service_request_type')
        ->selectRaw('SUM(CASE WHEN service_request_status = "Pending" THEN 1 ELSE 0 END) as pending,
                     SUM(CASE WHEN service_request_status = "Approved" THEN 1 ELSE 0 END) as approved,
                     SUM(CASE WHEN service_request_status = "Rejected" THEN 1 ELSE 0 END) as rejected,
                     service_request_type')
        ->groupBy('service_request_type')
        ->get();

        $yearlyServiceTypeRequests = ServiceRequest::whereYear('created_at', $currentYear)
        ->selectRaw('service_request_type, COUNT(*) as count')
        ->groupBy('service_request_type')
        ->get();

        $yearlyServiceTypeRequestsData = array_fill(0, count($serviceTypeRequestsLabel), 0);
        foreach ($yearlyServiceTypeRequests as $yearlyServiceTypeRequest) {
            $searchString = $yearlyServiceTypeRequest->service_request_type;
            $foundIndex = array_search($searchString, $serviceTypeRequestsLabel);
            if ($foundIndex !== false) {
                $yearlyServiceTypeRequestsData[$foundIndex] = $yearlyServiceTypeRequest->count;
            }
        }
/////////////////////////// REQUESTS (END)  ////////////////////////////////

        return view('management.service-staff.analytics', 
            compact(
                'labels',
                'monthlyRequestData',  
                'yearlyRequestsData', 
                'serviceTypeRequestsLabel',
                'monthlyServiceTypeRequestsData',
                'yearlyServiceTypeRequestsData',
                'monthlyServiceTypeRequestsStatus',
                'yearlyServiceTypeRequestsStatus',
            )
        );
    }

    public function generateUserReport()
    {

        $monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
            ];
        // Fetch data from the database for your report
        $data = User::all();

        $yearlyAccounts = User::whereYear('created_at', date('Y'))
            ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();

        $yearlyAccountsData = array_fill(0, 12, 0); // Initialize the array with 12 months

        foreach ($yearlyAccounts as $yearlyAccount) {
            $monthNumber = $yearlyAccount->month;
            $yearlyAccountsData[$monthNumber - 1] = $yearlyAccount->count;
        }

        // Define the CSV header
        $csvHeader = ['ID', 'First Name', 'Last Name','Email','Contact','Age','Gender','Occupation','Educational Level','Date Created'];

        // Create an array to store CSV rows
        $csvData = [$csvHeader];

        // Populate the CSV rows with data from the database
        foreach ($data as $item) {
            $csvData[] = [
                $item->id,
                $item->fname,
                $item->lname,
                $item->email,
                $item->contact,
                $item->age,
                $item->gender,
                $item->occupation,
                $item->educational_level,
                date('Y/m/d-H:i:s', strtotime($item->created_at)),
            ];
        }


        // Define the filename with a timestamp
        $filename = 'report(users)_' . date('Y-m-d') . '.csv';

        // Generate the CSV file
        $file = fopen($filename, 'w');
        fputcsv($file, ['Accounts Information']);
        foreach ($csvData as $csvRow) {
            fputcsv($file, $csvRow);
        }   

        fputcsv($file, ['']);
        fputcsv($file, ['Yearly Account Created'.'('.date('Y').')']);
        fputcsv($file, $monthNames);
        fputcsv($file, $yearlyAccountsData);

        fclose($file);

        // Return the download response using the filename
        return response()->download($filename)->deleteFileAfterSend(true);

        }

        // $pdf = new TCPDF();
        // $pdf->SetCreator('Your Application');
        // $pdf->SetAuthor('Your Name');
        // $pdf->SetTitle('Sample PDF Report');
        // $pdf->SetSubject('Sample PDF Report');
        // $pdf->SetKeywords('PDF, Report, Sample');

        // // // Add a watermark
        // // $watermark = asset('import/assets/images/logo/management/clsu-logo.png'); // Replace with the path to your watermark image
        // // $pdf->Image($watermark, 30, 50, 150, 0, 'png');

        // $pdf->AddPage();

        // // Add your content to the PDF
        // $pdf->SetFont('helvetica', '', );
        // $pdf->Cell(0, 10, 'Sample PDF Report', 0, 1, '');
        // $pdf->Ln(10);

        // // Fetch data from the database for your report
        // $data = User::all();

        // // Define the table headers
        // $headers = array('ID', 'First Name', 'Last Name','Email','Contact','Gender','Occupation','Educational Level');

        // // Create the table
        // $pdf->setFontSize(8);

        // // Define cell heights
        // $cellHeight = 10;
        
        // // Loop through the headers and create table cells
        // foreach ($headers as $key => $header) {
        //     // Determine the cell width based on the column index
        //     $cellWidth = ($key === 0) ? 5 : 30;
        
        //     $pdf->Cell($cellWidth, $cellHeight, $header, 1,'','');
        // }

        // $pdf->Ln();

        // // Loop through the data and add it to the table
        // $pdf->SetFont('helvetica', '', 8);
        // foreach ($data as $user) {
        //     $pdf->Cell(5, 5, $user->id, 1,'','',false,'','',true,'T','M');
        //     $pdf->Cell(30, 5, $user->fname, 1,'','',false,'','',true,'T','M');
        //     $pdf->Cell(30, 5, $user->lname, 1,'','',false,'','',true,'T','M');
        //     $pdf->Cell(30, 5, $user->email, 1,'','',false,'','',true,'T','M');
        //     $pdf->Cell(30, 5, $user->contact, 1,'','',false,'','',true,'T','M');
        //     $pdf->Cell(30, 5, $user->gender, 1,'','',false,'','',true,'T','M');
        //     $pdf->Cell(30, 5, $user->occupation, 1,'','',false,'','',true,'T','M');
        //     $pdf->Cell(30, 5, $user->educational_level, 1,'','',false,'','',true,'T','M');
        //     $pdf->Ln();
        // }

        // // Output the PDF
        // $pdf->Output('sample_report.pdf');

        // // You can also return the PDF as a response
        // return response($pdf->Output('sample_report.pdf'))->header('Content-Type', 'application/pdf');
        // }

        public function generateSubmissionReport()
        {


        // Fetch data from the database for your report
        $dataPublication = SubmissionPublication::with('user')->get();
        $dataService = ServiceRequest::with('user')->get();
        // $yearlyAccounts = User::whereYear('created_at', date('Y'))
        //     ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        //     ->groupBy('month')
        //     ->get();



        // Define the CSV header
        $csvPublicationHeader = [
            'ID', 
            'User ID', 
            'User Name',
            'Type',
            'Title',
            'Author',
            'Contributor',
            'Published Date',
            'Description',
            'Theme',
            'Volume',
            'Issue',
            'DOI',
            'Publisher',
            'Status',
            'Created',
        ];

        $csvServiceHeader = [
            'ID', 
            'User ID', 
            'User Name',
            'Agency',
            'Agency Classfication',
            'Client',
            'Service Type',
            'Training',
            'Analytics',
            'Technical Assistance',
            'Survey Description',
            'Survey Target',
            'Survey Coverage',
            'Status',
            'Created',
        ];

        // Create an array to store CSV rows
        $csvServiceData = [$csvServiceHeader];

        // Populate the CSV rows with data from the database
        foreach ($dataService as $item) {
            $csvServiceData[] = [
                $item->service_request_id,
                $item->service_request_user_id,
                $item->user->fname.' '.$item->user->lname,
                $item->service_request_agency,
                $item->service_request_agency_classification,
                $item->service_request_client,
                $item->service_request_type,
                $item->service_request_training_topic,
                $item->service_request_analysis,
                $item->service_request_software,
                $item->service_request_survey_description,
                $item->service_request_survey_target,
                $item->service_request_survey_coverage,
                $item->service_request_status,
                date('Y/m/d-H:i:s', strtotime($item->created_at)),
            ];
        }

        $csvPublicationData = [$csvPublicationHeader];
        foreach ($dataPublication as $item) {
            $csvPublicationData[] = [
                $item->submission_publication_id,
                $item->submission_publication_user_id,
                $item->user->fname.' '.$item->user->lname,
                $item->submission_publication_type,
                $item->submission_publication_title,
                $item->submission_publication_author,
                $item->submission_publication_contributor,
                $item->submission_publication_date,
                $item->submission_publication_description,
                $item->submission_publication_theme,
                $item->submission_publication_volume,
                $item->submission_publication_issue,
                $item->submission_publication_doi,
                $item->submission_publication_publisher,
                $item->submission_publication_status,
                date('Y/m/d-H:i:s', strtotime($item->created_at)),
            ];
        }



        // Define the filename with a timestamp
        $filename = 'report(submissions)_' . date('Y-m-d') . '.csv';

        // Generate the CSV file
        $file = fopen($filename, 'w');
        fputcsv($file, ['Publications Submitted']);
        foreach ($csvPublicationData as $csvRow) {
            fputcsv($file, $csvRow);
        }   

        fputcsv($file, ['']);
        fputcsv($file, ['Services Requested']);
        foreach ($csvServiceData as $csvRow) {
            fputcsv($file, $csvRow);
        }  

        fclose($file);

        // Return the download response using the filename
        return response()->download($filename)->deleteFileAfterSend(true);

        }
        public function generateSubmissionReportLibrary()
        {


        // Fetch data from the database for your report
        $dataPublication = SubmissionPublication::with('user')->get();



        // Define the CSV header
        $csvPublicationHeader = [
            'ID', 
            'User ID', 
            'User Name',
            'Type',
            'Title',
            'Author',
            'Contributor',
            'Published Date',
            'Description',
            'Theme',
            'Volume',
            'Issue',
            'DOI',
            'Publisher',
            'Status',
            'Created',
        ];



        // Populate the CSV rows with data from the database
        $csvPublicationData = [$csvPublicationHeader];
        foreach ($dataPublication as $item) {
            $csvPublicationData[] = [
                $item->submission_publication_id,
                $item->submission_publication_user_id,
                $item->user->fname.' '.$item->user->lname,
                $item->submission_publication_type,
                $item->submission_publication_title,
                $item->submission_publication_author,
                $item->submission_publication_contributor,
                $item->submission_publication_date,
                $item->submission_publication_description,
                $item->submission_publication_theme,
                $item->submission_publication_volume,
                $item->submission_publication_issue,
                $item->submission_publication_doi,
                $item->submission_publication_publisher,
                $item->submission_publication_status,
                date('Y/m/d-H:i:s', strtotime($item->created_at)),
            ];
        }



        // Define the filename with a timestamp
        $filename = 'report(submissions)_' . date('Y-m-d') . '.csv';

        // Generate the CSV file
        $file = fopen($filename, 'w');
        fputcsv($file, ['Publications Submitted']);
        foreach ($csvPublicationData as $csvRow) {
            fputcsv($file, $csvRow);
        }   

        fclose($file);

        // Return the download response using the filename
        return response()->download($filename)->deleteFileAfterSend(true);

        }

        public function generateSubmissionReportService()
        {


        // Fetch data from the database for your report
        $dataService = ServiceRequest::with('user')->get();
        // $yearlyAccounts = User::whereYear('created_at', date('Y'))
        //     ->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        //     ->groupBy('month')
        //     ->get();



        // Define the CSV header
        $csvServiceHeader = [
            'ID', 
            'User ID', 
            'User Name',
            'Agency',
            'Agency Classfication',
            'Client',
            'Service Type',
            'Training',
            'Analytics',
            'Technical Assistance',
            'Survey Description',
            'Survey Target',
            'Survey Coverage',
            'Status',
            'Created',
        ];

        // Create an array to store CSV rows
        $csvServiceData = [$csvServiceHeader];

        // Populate the CSV rows with data from the database
        foreach ($dataService as $item) {
            $csvServiceData[] = [
                $item->service_request_id,
                $item->service_request_user_id,
                $item->user->fname.' '.$item->user->lname,
                $item->service_request_agency,
                $item->service_request_agency_classification,
                $item->service_request_client,
                $item->service_request_type,
                $item->service_request_training_topic,
                $item->service_request_analysis,
                $item->service_request_software,
                $item->service_request_survey_description,
                $item->service_request_survey_target,
                $item->service_request_survey_coverage,
                $item->service_request_status,
                date('Y/m/d-H:i:s', strtotime($item->created_at)),
            ];
        }

        // Define the filename with a timestamp
        $filename = 'report(submissions)_' . date('Y-m-d') . '.csv';

        // Generate the CSV file
        $file = fopen($filename, 'w');
        fputcsv($file, ['Services Requested']);
        foreach ($csvServiceData as $csvRow) {
            fputcsv($file, $csvRow);
        }  

        fclose($file);

        // Return the download response using the filename
        return response()->download($filename)->deleteFileAfterSend(true);

        }

    
    public function generateDownloadReport()
        {

            // Fetch data from the database for your report
            $dataPublication = DownloadPublication::with('user')->get();
            $dataDataset = DownloadDataset::with('user')->get();
        
            // Define the CSV header
            $csvPublicationHeader = ['ID', 'User ID', 'User Name','Publication ID','Publication Title','Publication Author','Reason','Date Downloaded'];
            $csvDatasetHeader = ['ID', 'User ID', 'User Name','Dataset ID','Dataset Title','Dataset Author','Reason','Date Downloaded'];

            // Create an array to store CSV rows
            $csvPublicationData = [$csvPublicationHeader];
            $csvDatasetData = [$csvDatasetHeader];

            // Populate the CSV rows with data from the database
            foreach ($dataPublication as $item) {
                $csvPublicationData[] = [
                    $item->download_id,
                    $item->download_user_id,
                    $item->user->fname.' '.$item->user->lname,
                    $item->download_publication_id,
                    $item->download_publication_title,

                    $item->download_publication_author,
                    $item->download_reason,
                    date('Y/m/d-H:i:s', strtotime($item->created_at)),
                ];
            }
            foreach ($dataDataset as $item) {
                $csvDatasetData[] = [
                    $item->download_id,
                    $item->download_user_id,
                    $item->user->fname.' '.$item->user->lname,
                    $item->download_dataset_id,
                    $item->download_dataset_title,
                    $item->download_dataset_author,
                    $item->download_reason,
                    date('Y/m/d-H:i:s', strtotime($item->created_at)),
                ];
            }
    
    
            // Define the filename with a timestamp
            $filename = 'report(downloads)_' . date('Y-m-d') . '.csv';
    
            // Generate the CSV file
            $file = fopen($filename, 'w');
            fputcsv($file, ['Publication Downloads']);
            foreach ($csvPublicationData as $csvRow) {
                fputcsv($file, $csvRow);
            }   
            fputcsv($file, ['']);
            fputcsv($file, ['Dataset Downloads']);
            foreach ($csvDatasetData as $csvRow) {
                fputcsv($file, $csvRow);
            } 

            fclose($file);
    
            // Return the download response using the filename
            return response()->download($filename)->deleteFileAfterSend(true);
    
        }

    }

