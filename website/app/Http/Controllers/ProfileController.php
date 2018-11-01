<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Profile\ProfileCollection;
use App\Http\Requests\ProfileRequest;
use App\Model\Profile;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\YouAreNotAdmin;
use Auth;
use App\User;


class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->mAuthCheck();
        return ProfileCollection::collection(Profile::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $profile = new Profile;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->street = $request->street;
        $profile->parish = $request->parish;
        $profile->mobile = $request->mobile;
        $profile->landline = $request->landline;
        $profile->farm_name = $request->farm_name;
        $profile->farm_address_steet = $request->farm_address_steet;
        $profile->farm_address_parish = $request->farm_address_parish;
        $profile->flock_capacity = $request->flock_capacity;
        $profile->principal_occupation = $request->principal_occupation;
        $profile->qualifications = $request->qualifications;
        $profile->training = $request->training;
        $profile->save();
        return response([
            'data' => new ProfileResource($profile)
        ],Response::HTTP_CREATED);
    }

    public function show(Profile $profile)
    {
        $this->ProfileUserCheck($profile);
        return new ProfileResource($profile);

    }

    public function edit(Profile $profile)
    {
        //
    }


    public function update(Request $request, Profile $profile)
    {
        $this->ProfileUserCheck($profile);
        $profile->update($request->all());
        return response([
            'data' => new ProfileResource($profile)
        ],Response::HTTP_CREATED);
    }


    public function destroy(Profile $profile)
    {
        $this->ProfileUserCheck($profile);

        $user = User::findOrFail($profile->user_id);
        $profile->delete();
        $user->delete();
        return response(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    function ProfileUserCheck($profile)
    {
        $user = Auth::user();
        // dd($user->password);
        // $profile->role != "admin";
        // if(Auth::id() !== $profile->user_id){
        //     throw new YouAreNotAdmin;
        // }
        if($user->role !== "admin" and Auth::id() !== $profile->user_id ){
            throw new YouAreNotAdmin;
        }
    }


    public function mAuthCheck()
    {
        $user = Auth::user();
        if($user->role !== "admin"){
            throw new YouAreNotAdmin;
        }
    }

    
}

