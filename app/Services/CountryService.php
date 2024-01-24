<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CountryService
{
    public function GetAllCountries()
    {
        $countries = Country::all();
        Log::channel('country')->debug("get country response :: ".json_encode($countries));
        return $countries;
    }

    public function UpdateCountry($id,$request)
    {
        $data = [
            'name_en'        => $request->input('name_en'),
            'name_ar'        => $request->input('name_ar'),
            'description_en' => $request->input('description_en'),
            'description_ar' => $request->input('description_ar'),
        ];
        $country = Country::where('id', $id)->update($data);
        Log::channel('country')->debug("update :: ".json_encode($data)." - response :: ".json_encode($country));

        return $country;
    }
    public function StoreCountry($request)
    {
        $data = [
            'name_en'        => $request->input('name_en'),
            'name_ar'        => $request->input('name_ar'),
            'description_en' => $request->input('description_en'),
            'description_ar' => $request->input('description_ar'),
        ];
        $country = Country::create($data);
        Log::channel('country')->debug("store :: ".json_encode($data)." - response :: ".json_encode($country));
        return $country;
    }

    public function DeleteCountry($id)
    {
        $country = Country::where('id', $id)->delete();
        Log::channel('country')->debug("delete :: ".json_encode($id)." - response :: ".json_encode($country));
        return $country;
    }

    public function getListOfCountries()
    {
        $countries = Country::all();
        return $countries;
    }
    public function GetCountryById($id)
    {
        $country = Country::where('id', $id)->first();
        return $country;
    }

    public function triggerCallBack($request, $countries)
    {
        if ($request->callbackUrl) {
            Cache::put('callbackUrl', $request->callbackUrl);
            $client = new \GuzzleHttp\Client(['verify' => false]);
            $client->request('GET', $request->callbackUrl, [
                'json' => $countries
            ]);
        }
    }

}