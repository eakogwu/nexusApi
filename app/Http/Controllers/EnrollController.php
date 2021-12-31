<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollRequest;
use App\Mail\EnrolledMail;
use App\Models\Enroll;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $enrolls = Enroll::all();
        return response([
            'data' => $enrolls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EnrollRequest $request
     * @return Response
     */
    public function store(EnrollRequest $request): Response
    {
        $person = new Enroll;
        $person->firstname = $request->firstname;
        $person->lastname  = $request->lastname;
        $person->email     = $request->email;
        $person->phone     = $request->phone;
        $person->save();
        Mail::to($person)->send( new EnrolledMail($person));
        return response([
           'message' => 'successful',
            'data' => $person
        ],201);


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id): Response
    {
        $enroll = Enroll::where( 'id', $id)->first();
        if ($enroll){
            $enroll->delete();
            return response([
                'message' => 'deleted successfully'
            ],201);
        }else{
            return response([
                'message' => 'Not found'
            ],404);
        }
    }
}
