<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public $data = [];

    public function login() {
        return view('pages.admin.login');
    }
    
    public function dashboard(Request $request) {
        $this->data['dashboard'] = globalHelper()->getDashboardData();
        return globalHelper()->makeView('pages.admin.dashboard', $this->data, $request);
    }

    public function applications(Request $request) {
        $this->data['courses'] = config('custom.courses');
        return globalHelper()->makeView('pages.admin.applicants', $this->data, $request);
    }

    public function process($id, Request $request) {
        
        $this->data['document_statuses'] = config('custom.doc_status');
        $this->data['timelines'] = globalHelper()->getDetailedTimeline($id, $id);
        $this->data['timeline'] = globalHelper()->getTimeline($id, $id);
        $this->data['profile'] = globalHelper()->getApplicantProfile($id);
        $this->data['applicant'] = globalHelper()->getApplicantInformation($id);
        $this->data['req_types'] = globalHelper()->getRequirementTypes();
        $this->data['documents'] = globalHelper()->getApplicantDocuments($id);
        return globalHelper()->makeView('pages.admin.process', $this->data, $request);
    }

    public function batch(Request $request) {
        $this->data['courses'] = config('custom.courses');
        return globalHelper()->makeView('pages.admin.batch_invitation', $this->data, $request);
    }
    
}