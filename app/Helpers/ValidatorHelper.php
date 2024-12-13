<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Exceptions\GlobalException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper {
    public const EXCLUDED = ['current_user', 'current_user_settings'];
    
    public function validate(string $type, Request $request): array {
    
        $mapped = $this->key_map($request->except(self::EXCLUDED));
        
        if (isset($mapped['photo']) && (! $mapped['photo'] || $mapped['photo'] === "undefined")) {
            unset($mapped['photo']);
        }
                
        $validated = Validator::make($mapped, $this->rules($type));
        
        if ($validated->fails()) {
            return [
                'status' => 'error',
                'message' => $validated->errors()->first(),
            ];
        }

        return [
            'status' => 'ok',
            'validated' => $validated->validated(),
        ]; 
    }

    private function key_map($to_map): array {

        $mapped = [];
        foreach($to_map as $key => $value) {
            if($value) {
                $mapped[keyHelper()->getKey($key)] = $value;
            }
        }

        return $mapped;
    }

    private function rules(string $type) {
        switch($type) {

            case 'accounts_save':
                return [
                    'firstname' => "required|string|max:255",
                    'middlename' => "required|string|max:255",
                    'lastname' => "required|string|max:255",
                    'birthdate' => "required|string|max:255",
                    'phone' => "required|string|max:255",
                    'email' => "required|email|max:255",
                    'password' => "required|string|max:255",
                    'confirm_password' => "required|string|max:255",
                ];
            break;

            case 'accounts_update':
                return [
                    'firstname' => "sometimes|string|max:255",
                    'middlename' => "sometimes|string|max:255",
                    'lastname' => "sometimes|string|max:255",
                    'birthdate' => "sometimes|string|max:255",
                    'phone' => "sometimes|string|max:255",
                    'email' => "sometimes|email|max:255",
                    'password' => "sometimes|string|max:255",
                ];
            break;

            case 'verify_email':
                return [
                    'email' => "required|email|max:255",
                    'otp' => "required|string|max:6",
                ];
            break;

            case 'resend_otp':
                return [
                    'email' => "required|email|max:255",
                ];
            break;

            case 'document_upload':
                return [
                    'document' => "required|mimes:pdf|max:20000",
                ];
            break;

            case 'players_save':
                return [
                    'photo' => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
                    'firstname' => "required|string|max:255",
                    'middlename' => "required|string|max:255",
                    'lastname' => "required|string|max:255",
                    'nationality_id' => "required|integer|max:6",
                    'arrival_date' => "required|string|max:255",
                    'deposit' => "required|string|max:255",
                    'agent_code' => "required|string|max:255",
                ];
            break;

            case 'players_update':
                return [
                    'firstname' => "sometimes|string|max:255",
                    'middlename' => "sometimes|string|max:255",
                    'lastname' => "sometimes|string|max:255",
                    'nationality_id' => "sometimes|integer|max:6",
                    'arrival_date' => "sometimes|string|max:255",
                    'photo' => "sometimes|string|max:255",
                    'deposit' => "sometimes|string|max:255",
                    'checkout' => "sometimes|string|max:255",
                    'status' => "sometimes|integer|max:6",
                    'availment_id' => "sometimes|integer|max:6",
                    'checked_in_by' => "sometimes|string|max:255",
                    'checked_out_by' => "sometimes|string|max:255",
                ];
            break;

            case 'agents_save':
                return [
                    // 'photo' => "somteimtes|image|mimes:jpeg,png,jpg,gif|max:2048",
                    'firstname' => "required|string|max:255",
                    'middlename' => "required|string|max:255",
                    'lastname' => "required|string|max:255",
                    'phone' => "required|string|max:255",
                    'email' => "sometimes|email|max:255",
                ];
            break;

            case 'transactions_save':
                return [
                    'photo' => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
                    'availment_id' => "required|integer|max:255",
                    'reference_number' => "required|string|max:255",
                    'total_amount' => "required|string|max:255",
                    'remarks' => "sometimes|string",
                ];
            break;

            case 'transactions_update':
                return [
                    'player_id' => "sometimes|integer|max:255",
                    'availment_id' => "sometimes|integer|max:255",
                    'accomodation' => "sometimes|string|max:255",
                    'room' => "sometimes|string|max:255",
                    'restaurant' => "sometimes|string|max:255",
                    'foods' => "sometimes|string|max:255",
                    'receipt' => "sometimes|string|max:255",
                    'total_amount' => "sometimes|string|max:255",
                ];
            break;
        }
    }
}