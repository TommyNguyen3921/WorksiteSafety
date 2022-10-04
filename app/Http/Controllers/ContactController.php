<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Validator;
class ContactController extends Controller
{
    function addcontact(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'phone' => 'required',
            'message' => 'required|max:500'
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(),401);
        }else{
            $contactinfo = new ContactInfo;
            $contactinfo ->name = $request->input('name');
            $contactinfo ->email = $request->input('email');
            $contactinfo ->phone = $request->input('phone');
            $contactinfo ->message = $request->input('message');
            $result = $contactinfo ->save();
            if($result){

                $to = [
                    [
                        'email' => 'devtest@worksite.ca', 
                        'name' => 'worksite',
                    ]
                ];
            
                \Illuminate\Support\Facades\Mail::to($to)
                    ->send(new \App\Mail\ContactMail());

                return ["Result"=>"data has been saved"];
            }else{
                return ["Result"=>"data not saved"];
            }
        }


    
        
    }
}
