<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTruckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     * id = "3"
    name = "Foodtruck 2"
    phone = "987-544-2598 x61823"
    address = "27315 Elmer Park Suite 796\r\nPort Josefinabury, VT 69074"
    identification = "13.968.962/0001-80"
    formal_name = "VIZAD SOLUCOES LTDA"
    service_type_id = "25"
    status = "unavailable"
    users_0 = "[object Object]"
    users_diff = "function (a){return this.filter?this.filter(function(i){return a.indexOf(i)<0}):[]}"
    service_type_name = "Bagels"
    service_type_slug = "bagels"
    logo_url = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAADxUAAAoOCAIAAAB47GsRAAAACXBIWXMAAC4jAAAuIwF4pT92AAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAaV5pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTExIDc5LjE1ODMyNSwgMjAxNS8wOS8xMC0wMToxMDoyMCAgICAgICAgIj4KICAgPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIKICAgICAgICAgICAgeG1sbnM6YXV4PSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wL2F1eC8iCi"
     */
    public function rules()
    {
        if(Auth::user()->hasRole('admin'))
        {
            return [
                'foodtruck_new_logo'=>'image',
                'foodtruck_id'=>'required|exists:trucks,id',
                'foodtruck_service_type_id'=>'required|exists:service_types,id',
                'foodtruck_status' => 'required|in:available,unavailable,transit,denied',
                'foodtruck_name'=>'required|min:2|max:255',
                'foodtruck_phone' => 'required',
                'foodtruck_address' => 'required|max:255',
                'foodtruck_identification' => 'required|min:18',
                'foodtruck_formal_name' => 'required|max:100',
                'foodtruck_lets_negotiate' => 'required',
                'foodtruck_delivery_bike' => 'required',
                'foodtruck_delivery_motorcycle' => 'required',
            ];
        }else{
            return [
                //
            ];
        }

    }
}
