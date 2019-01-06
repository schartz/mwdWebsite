<?php
/**
 * Created by PhpStorm.
 * User: schartz
 * Date: 12/23/2018
 * Time: 1:52 PM
 */

namespace App\Http\Controllers;


use App\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TutorialController extends Controller
{

    public function list()
    {
        return 'This is the list of tutorials';

    }

    /**
     * This function creates a new tutorial record in the databsae
     * @param Request $request
     * @return Tutorial
     */
    public function create(Request $request)
    {

        $data = $request->all();
        $rules = [
           'title' => 'required|min:3',
            'body' => 'required|min:5'
        ];

        // validator instance
        $validator = Validator::make($data, $rules);


        // handle the error case, gracefully
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $tut = new Tutorial();
        $tut->title = $data['title'];
        $tut->body = $data['body'];
        $tut->author_id = 1;

        $tut->save();


        return $tut;

    }

    public function index()
    {
        $tutsList = Tutorial::all();
        return $tutsList;
    }

    public function update(Request $request)
    {
        $data = $request->all();


        // validator instance
        $validator = Validator::make($data, [
            'title' => 'required|min:3',
            'body' => 'required|min:5'
        ]);


        // handle the error case, gracefully
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }






        // Step 1: FInd the tutorial
        $tut = Tutorial::where('id', $data['id'])->first();


        // Step 2: Update the information
        $tut->title = $data['title'];
        $tut->body = $data['body'];

        // Step 3: Save this updated tutorial object into the database
        $tut->save();
        // Step 4: Return the updated result to hooman
        return $tut;
    }

    public function delete($tutId)
    {
        /*// find the record
        $tut = Tutorial::where('id', $tutId)->first();


        // delete it
        $tut->delete();*/

        Tutorial::destroy($tutId);


        //send response
        return "Deleted tut with an ID of: " . $tutId;
    }
}