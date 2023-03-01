<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizeQuestionController extends Controller
{

    use \App\Http\Traits\CommonTraits;
    
    public function createQuizeQuestions(Request $request)
    {

        $request['field3'] = (bool) $request['field3'];

        $requestAcceptableKeys = [
            'field1',   // title
            'quize_id', // quize id
            'field3',   // is mandatory ?
            'option',   // option title
            'optionIsTrue'  // is correct answer ? true : false
        ];

        $customMessages = [
            'field1.required' => 'Question title is required',
            'quize_id.required' => 'Question must belong to a quize.',
            'field3.required' => 'Question must be mandatory or not.',
            'option.required' => 'Question must have one or more options.',
            'optionIsTrue.required' => 'Options must either be TRUE or FALSE.',
        ];
        
        $validator = Validator::make( $request->only($requestAcceptableKeys),[
            'field1' => 'required|string',
            'quize_id' => 'required|integer',
            'field3' => 'required|boolean',
            'option' => 'required|array',
            'optionIsTrue' => 'required|array'
        ], $customMessages);

        if( $validator->fails() ) return $this->response(null, 412, $validator->errors() );


        // Validate quize
        $quize = \App\Models\Quize::find($request->input('quize_id'));
        if( ! $quize ) return $this->response(null, 412, ['Quize not found.'] );

        // Validate options
        if( count($request->input('option')) != count($request->input('optionIsTrue')) ) return $this->response(null, 412, ['Incorrect option data.'] );

        $question = \App\Models\QuizeQuestion::create([
            'field1' => $request->input('field1'),
            'quize_id' => $request->input('quize_id'),
            'field3' => $request->input('field3'),
        ]);

        
        $optionIsTrue = $request->input('optionIsTrue');
        $option_data = array_map(function($optionTitle, $index) use ($question, $optionIsTrue ){

            return [
                'field1' => $optionTitle,
                'field2' => (boolean) $optionIsTrue[$index],
                'quizeQuestion_id' => $question->id,

            ];

        }, $request->input('option'), array_keys($request->input('option')) );

        $options = \App\Models\QuizeQuestionOption::insert($option_data);
        
        return $this->response($quize->with('questions')->get());
        
    }


}
