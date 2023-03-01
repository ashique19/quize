<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Quize;

class QuizeController extends Controller
{

    use \App\Http\Traits\CommonTraits;
    
    public function createQuize(Request $request)
    {
        $request['field3'] = (bool) $request['field3'];

        $requestAcceptableKeys = [
            'field1', // title
            'field2', // description
            'field3', // is published ?: draft
        ];

        $customMessages = [
            'field1.required' => 'Quize must have a Title',
            'field2.required' => 'Please write a short description for quize.',
            'field3.required' => 'Please mark if the quize should be saved as DRAFT or PUBLISHED',
        ];
        
        $validator = Validator::make($request->only($requestAcceptableKeys),[
            'field1' => 'required|string',
            'field2' => 'required|string',
            'field3' => 'required|boolean',
        ],$customMessages);


        // uwz57fm3rv1tl
        // nsilsufvkyye
        // uwz57fm3rv1tl

        if( $validator->fails() )
        {
            
            return $this->response(null, 412, $validator->errors() );

        }
        
        $quize = Quize::create([
            'field1' => $request['field1'],
            'field2' => $request['field2'],
            'field3' => $request['field3'],
        ]);

        if( $quize )
        {

            return $this->response($quize );

        }
        
    }


    public function getQuizes()
    {
        
        return $this->response(\App\Models\Quize::latest()->with('questions')->get());
        
    }

}
