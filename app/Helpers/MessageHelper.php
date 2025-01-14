<?php
    declare(strict_types=1);
    namespace App\Helpers;
    
    use App\Exceptions\GlobalException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class MessageHelper {
        
        public function getEmailSubject(string $type): string {
            
            switch($type) {
                case 'registration':
                        return "ETEEAP-AU Registration";
                    break;
                
                default: 
                        return "ETEEAP-AU";
                    break;
            }


        }


        public function getEmailView(string $type): string {
            
            switch($type) {
                case 'registration':
                        return "email_verification";
                    break;
                case 'resend-otp':
                        return "resend_otp";
                    break;
                case 'invite':
                        return "send_invite";
                    break;
                
                default: 
                        return "";
                    break;
            }


        }
    }