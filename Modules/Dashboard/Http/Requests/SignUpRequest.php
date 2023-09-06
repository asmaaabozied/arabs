<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Region\Entities\City;
use Modules\Region\Entities\Country;

class SignUpRequest extends FormRequest
{
    public function countries(){
        $countries = Country::withoutTrashed()->get();
        for ($i=0;$i<count($countries);$i++){
            $array_of_countries [] = $countries[$i]->id;
        }
        return [
            'array_of_countries' => $array_of_countries,
        ];
    }
    public function cities(){
        $cities = City::withoutTrashed()->get();
        for ($i=0;$i<count($cities);$i++){
            $array_of_cities [] = $cities[$i]->id;
        }
        return [
            'array_of_cities' => $array_of_cities,
        ];
    }

    public function rules()
    {
        $cities = $this->cities();
        $countries = $this->countries();

        // Get the selected registration_type from the request
        $registrationType = $this->input('registration_type');

        // Define common rules that apply to both registration types
        $commonRules = [
            'name' => 'required|string|min:3|max:255',
            'country' => ['required', 'integer', Rule::in($countries['array_of_countries'])],
            'city' => ['required', Rule::in($cities['array_of_cities'])],
            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
//                'regex:/[@$!%*#?&]/', // must contain a special character
                'confirmed',
            ],
        ];

        // Define rules specific to each registration type
        $typeSpecificRules = [
            'employer' => [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('employers', 'email'),
                ],
                'phone' => [
                    'required',
                    'numeric',
                    Rule::unique('employers', 'phone'),
                ],
            ],
            'worker' => [
                'email' => [
                    'required',
                    'email',
                    Rule::unique('workers', 'email'),
                ],
                'phone' => [
                    'required',
                    'numeric',
                    Rule::unique('workers', 'phone'),
                ],
            ],
        ];

        // Merge the common rules with type-specific rules based on registration_type
        $rules = array_merge($commonRules, $typeSpecificRules[$registrationType]);

        dd($rules);
        return $rules;

    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function messages(): array
    {
        return [
            'name.required'=>trans('dashboard::validation.required'),
            'name.string'=>trans('dashboard::validation.string'),
            'name.min'=>trans('dashboard::validation.min'),
            'name.max'=>trans('dashboard::validation.max'),




            'email.required'=>trans('dashboard::validation.required'),
            'email.email'=>trans('dashboard::validation.email'),
            'email.unique'=>trans('dashboard::validation.unique'),




            'country.required'=>trans('dashboard::validation.required'),
            'country.integer'=>trans('dashboard::validation.integer'),
            'country.in'=>trans('dashboard::validation.in'),


            'city.required'=>trans('dashboard::validation.required'),
            'city.integer'=>trans('dashboard::validation.integer'),
            'city.in'=>trans('dashboard::validation.in'),


            'phone.required'=>trans('dashboard::validation.required'),
            'phone.numeric'=>trans('dashboard::validation.numeric'),
            'phone.unique'=>trans('dashboard::validation.unique'),

            'password.required'=>trans('dashboard::validation.required'),
            'password.min'=>trans('dashboard::validation.min'),
            'password.regex'=>trans('dashboard::validation.custom_regex'),
            'password.confirmed'=>trans('dashboard::validation.confirmed'),


        ];
    }

}
