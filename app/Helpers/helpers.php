<?php

use App\Helpers\ApiHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\KeysHelper;
use App\Helpers\LookupHelper;
use App\Helpers\MessageHelper;
use App\Helpers\ValidatorHelper;
use App\Helpers\ViewHelper;

function keyHelper() {
    return new KeysHelper;
}

function apiHelper() {
    return new ApiHelper;
}

function validatorHelper() {
    return new ValidatorHelper();
}

function globalHelper() {
    return new GlobalHelper;
}

function viewHelper() {
    return new ViewHelper;
}

function lookupHelper() {
    return new LookupHelper;
}

function messageHelper() {
    return new MessageHelper;
}