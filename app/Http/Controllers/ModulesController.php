<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModulesController extends Controller {

    public $data = [];

    public function login() {
        return view('pages.login');
    }

    public function registration() {
        return view('pages.registration');
    }
        
    public function verify_email(Request $request) {
        $email = "";
        if ($request->has('email')) {
            $email = $request->input('email');

            apiHelper()->custom_session($request, 'set', ['sess_verify_email' => $email]);
        }

        return view('pages.verify_email', ['email' => $email]);
    }

    public function dashboard(Request $request) {
        
        return globalHelper()->makeView('pages.applicant.dashboard', [], $request)->with([
            'current_user' => $request->current_user,
        ]);
    }

    public function information(Request $request) {
        
        
        return globalHelper()->makeView('pages.applicant.dashboard', [], $request)->with([
            'current_user' => $request->current_user,
        ]);

    }

    public function documents(Request $request) {
        
        $this->data['req_types'] = globalHelper()->getRequirementTypes();
        $this->data['documents'] = globalHelper()->getApplicantDocuments(Auth::id());
        
        $this->data['title'] = "Documents";
        return globalHelper()->makeView('pages.applicant.documents', $this->data, $request)->with([
            'current_user' => $request->current_user,
        ]);

    }

    public function education(Request $request) {
        
        return globalHelper()->makeView('pages.applicant.education', [], $request)->with([
            'current_user' => $request->current_user,
        ]);

    }

    public function experience(Request $request) {
        
        return globalHelper()->makeView('pages.applicant.experience', [], $request)->with([
            'current_user' => $request->current_user,
        ]);

    }

    public function timeline(Request $request) {
        
        return globalHelper()->makeView('pages.applicant.timeline', [], $request)->with([
            'current_user' => $request->current_user,
        ]);

    }

    public function messages(Request $request) {
        
        return globalHelper()->makeView('pages.applicant.messages', [], $request)->with([
            'current_user' => $request->current_user,
        ]);

    }
}