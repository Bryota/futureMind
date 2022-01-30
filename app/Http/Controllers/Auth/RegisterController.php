<?php

namespace App\Http\Controllers\Auth;

use App\DataProvider\Storage\S3\S3Interface\S3Interface;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\DataProvider\Eloquent\Company;
use Intervention\Image\Facades\Image;
use App\Services\ImgToDatabase;


class RegisterController extends Controller
{
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * @var S3Interface $storage S3Interfaceインスタンス
     */
    private $storage;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(S3Interface $storage)
    {
        $this->middleware('guest');
        $this->middleware('guest:company');
        $this->storage = $storage;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required'],
            'university' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'year' => $data['year'],
            'university' => $data['university'],
        ]);
    }

    protected function companyValidator(array $data){
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:255'],
            'company_icon' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function showCompanyRegisterForm(){
        return view('company.register',['authgroup'=>'company']);
    }

    protected function createCompany(Request $request)
    {
        $img_name = null;
        if(isset($request->company_icon)){
            $this->storage->putFileToCompany($request->company_icon);
            $img_name = 'companies/' . $request->company_icon->getClientOriginalName();
        }
        $this->companyValidator($request->all())->validate();
        $company = Company::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'company_icon' => $img_name
        ]);
        if(Auth::guard('company')->attempt(['email' => $request->email,'password'=>$request->password],$request->get('remember'))){
            return redirect('/company');
        }
        return redirect('/company/login');
    }
}
