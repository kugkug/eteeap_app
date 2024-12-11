<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Models\Agent;
use App\Models\Company;
use App\Models\FoodBeverage;
use App\Models\Nationality;
use App\Models\Player;
use App\Models\Position;
use App\Models\User;

class LookupHelper {

    public function getCompanies(): array {
        return Company::orderBy('name', 'asc')->get()->toArray();
    }

    public function getPositions(): array {
        return Position::orderBy('position', 'asc')->get()->toArray();
    }

    public function getNationalities(): array {
        return Nationality::orderBy('nationality', 'asc')->get()->toArray();
    }

    public function getFNB(): array {
        return FoodBeverage::orderBy('type', 'asc')->get()->toArray();
    }

    public function getAccountInfoViaId(int $id): array {
        return User::where('id', $id)->first()->toArray();
    }

    public function getPlayerInfoViaId(int $id): array {
        return Player::where('id', $id)
            ->with('nationality')
            ->with('agent')
            ->first()->toArray();
    }

    public function getCompanyInfoViaId(int $id) {
        return Company::where('id',$id)->first()->toArray(); 
    }

    public function getAllAgents(): array {
        return Agent::where('status', 1)->orderBy('firstname', 'asc')->get()->toArray();
    }
}