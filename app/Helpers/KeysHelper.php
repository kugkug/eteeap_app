<?php

declare(strict_types=1);
namespace App\Helpers;

class KeysHelper {
    private const KEYS = [
        "Accomodation" => "accomodation",
        'Address' => "address",
        "AgentCode" => "agent_code",
        'ApprovedCourse' => "approved_course",
        "ArrivalDate"=> "arrival_date",
        "AvailmentId"=> "availment_id",        
        "Birthdate"=> "birthdate",
        "CheckedInBy"=> "checked_in_by",
        "CheckedOutBy"=> "checked_out_by",
        "Checkout" => "checkout",
        'Code' => "code",
        'CompanyAddress' => "company_address",
        'CompanyName' => "company",
        'ContactNo' => "phone",
        'ConfirmPassword' => "confirm_password",
        "Deposit"=> "deposit",
        'DesiredCourse' => "desired_course",
        "Document"=> "document",
        'Email' => "email",
        'EmployeeID' => "emp_id",
        'FirstName' => "firstname",
        "Foods" => "foods",
        'Id' => "id",
        'Identity' => "identity",
        'Image' => "photo",
        'LastName' => "lastname",
        'MiddleName' => "middlename",
        'Name' => "name",
        "NationalityId" => "nationality_id", 
        "Otp" => "otp", 
        'Password' => "password",
        "PassportImage" => "passport_image", 
        "PassportNo" => "passport_number", 
        "PlayerCode" => "player_code", 
        "PlayerId" => "player_id",
        'PositionId' => "user_type",
        'Position' => "position",
        "Receipt" => "receipt",
        "Remarks" => "remarks",
        'Representative' => "representative",
        "Restaurant" => "restaurant",
        "ReferenceNo" => "reference_number",
        "Room" => "room",
        'Skills' => "skills",
        'Status' => "status",
        "TotalAmount" => "total_amount",
        'Username' => "username",
    ];
    
    public function getKey(string $key_index): string {
        return self::KEYS[$key_index];
    }
}