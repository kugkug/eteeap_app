<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModulesController extends Controller {

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

    public function profile() {
        return view('pages.profile');
    }
}