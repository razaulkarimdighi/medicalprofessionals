<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\Utils\FileUploadService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

         return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_type' => ['required', 'string'],
            "anesthesiologist_type" => "required_if:user_type,==,anesthesiologists",
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        if($data['user_type'] == User::USER_TYPE_MEDICAL_PRACTICES){
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'location' => $data['location'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'user_type' => $data['user_type'],
                'password' => Hash::make($data['password']),
            ]);

            if ($user) {
                // $image = $this->fileUploadService->upload($data['honorary_note'], User::FILE_STORE_HONORARY_PATH, false, true);
                // $user->honorary_note = $image;
                // $user->save();
            }

             return $user;


        }else{
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'location' => $data['location'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'user_type' => $data['user_type'],
                'anesthesiologist_type' =>   $data['anesthesiologist_type'],
                'password' => Hash::make($data['password']),
            ]);

            if ($user) {
                // $image = $this->fileUploadService->upload($data['honorary_note'], User::FILE_STORE_HONORARY_PATH, false, true);
                // $user->honorary_note = $image;
                // $user->save();
            }

             return $user;
        }



    }
}
