<?php

namespace App\Http\Controllers;

use App\Events\CountryEvent;
use App\Services\CountryService;
use App\Services\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CountryController
{

    public function __construct(private CountryService $countryService, private LogService $logService){}

    public function GetAllCountries()
    {
        $countries = $this->countryService->GetAllCountries();
        return ApiResponseData($countries);
    }

    public function StoreCountry(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return ApiResponseMessageWithErrors(__('validation.check'),$validator->errors(), 400);
        }
        $country = $this->countryService->StoreCountry($request);
        if (!$country) {
            return ApiResponseMessage("An error occurred while storing country", 404);
        }
        event(new CountryEvent($request->method(),[], $request->all(), Cache::get('callbackUrl')));
        return ApiResponseData($country);

    }
    public function UpdateCountry(Request $request)
    {
        $validator = Validator::make($request->all(),['id' => ['required', 'integer']]);
        if ($validator->fails()) {
            return ApiResponseMessageWithErrors(__('validation.check'),$validator->errors(), 400);
        }
        $oldCountry = $this->countryService->GetCountryById($request->input('id'));
        $country = $this->countryService->UpdateCountry($request->input('id'), $request);
        if (!$country) {
            return ApiResponseMessage("An error occurred while updating country", 404);
        }
        event(new CountryEvent($request->method(),$oldCountry->toArray(), $request->all(), Cache::get('callbackUrl')));

        return ApiResponseMessage("Country updated successfully");
    }

    public function DeleteCountry(Request $request)
    {
        $validator = Validator::make($request->all(),['id' => ['required', 'integer']]);
        if ($validator->fails()) {
            return ApiResponseMessageWithErrors(__('validation.check'),$validator->errors(), 400);
        }
        $country = $this->countryService->DeleteCountry($request->input('id'));
        return ApiResponseData($country);
    }

    public function getCountries(Request $request)
    {
        try {
            $countryLogRequests = $this->logService->logListOfCountries($request);
            if (!$countryLogRequests) {
                return ApiResponseMessage("An error occurred while logging countries", 404);
            }
            $countries = $this->countryService->getListOfCountries();
            if (!$countries) {
                return ApiResponseMessage("An error occurred while getting countries", 404);
            }
            $this->countryService->triggerCallBack($request, $countries);
            return ApiResponseData([
                'countries' => $countries,
                'callbackUrl' => $request->callbackUrl ?? null
            ]);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            return ApiResponseMessageWithErrors($message, '', 400);
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name_en'        => ['required', 'string', 'max:255'],
            'name_ar'        => ['required', 'string', 'max:255'],
            'description_en' => ['string', 'max:255'],
            'description_ar' => ['string', 'max:255'],
        ]);
    }




}