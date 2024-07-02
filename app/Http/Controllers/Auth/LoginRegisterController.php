<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Otp;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Email\EmailService;
use App\Http\Requests\Auth\LoginRegisterRequest;
use App\Http\Requests\Auth\RegisterCompleteClientRequest;
use App\Http\Requests\Auth\RegisterCompeleteConsultantRequest;
use App\Models\Consultant;

class LoginRegisterController extends Controller 
{ 

    /**
     * @bodyParam register required The email of the user. Example: 9
     * @bodyParam guard required string must be:client or consultant.
    */
    public function loginRegister(LoginRegisterRequest $request){

        $inputs = $request->validated();

        $userTypeChecked = $this->checkInputsType($inputs);
       
        //create client 

        if(empty($userTypeChecked['user'])){

        $user =  $this->createNewUser($userTypeChecked['newUser'],$inputs['guard']);

        }
        else{ 

            $user = $userTypeChecked['user'];
        }
 
        //create otp

        $otp = $this->createUserOtp($user,$inputs['guard']);

        //send otp code to use 

        $result = $this->sendOtpCodeToClientEmail($user,$otp->otp_code);


        if($result == true){

            $create_time = (Carbon::parse($otp->created_at)->addMinutes(5)->timestamp - Carbon::now()->timestamp) * 1000;
    
            return response()->json(['token' => $otp->token , 'status' => true , 'created_time' => $create_time]);

        }
        else{

            
            return response()->json(['token' => $result , 'status' => false , 'message' => 'مشکلی بوجود آمده دوباره تلاش کنید'],422);

        }
         
    } 

    /**
     * @queryParam token required The token of the .
     * @bodyParam otp required The number. Example: 123456
     * @bodyParam guard required string must be:client or consultant.
    */

    public function loginConfirm($token,LoginRegisterRequest $request){

        $inputs = $request->validated();

        $otp = Otp::where([['token',$token],['used',0],['created_at','>=',Carbon::now()->subMinute(5)->toDateTimeString()]])->first();

        if(empty($otp)){


            return response()->json(['message' => 'شناسه وارد شده نا معتبر است','status' => false],422);

        }

        if($otp->otp_code != $inputs['otp']){


            return response()->json(['message' => 'کد احراز هویت نادرست است','status' => false],422);



        }

        //every thing is ok get user

        $otp->update(['used' => 1]);

        $modelClass = $inputs['guard'] == 'client' ? 'App\Models\Client':'App\Models\Consultant';

        $user = $modelClass::find($otp->otpable_id);
 
        if(auth()->guard($inputs['guard'])->attempt(['email' => $user->email,'password' => 'password'])){


            $resource = $inputs['guard'] == 'client' ? 'App\Http\Resources\ClientResource':'App\Http\Resources\ConsultantResource';

            return response()->json(['msg' => 'ورود کاربر با موفقیت انجام شد' , 
            'status' => true , new $resource($user)]);


       }
       else{

        return response()->json(['msg' => 'مشکلی بوجود آمده است' , 'status' => false ]);


       }
    }

    public function logout(Request $request){
 
        $request->user()->currentAccessToken()->delete();

        return response()->json(['msg' => 'عملیات خروج با موفقیت انجام شد' , 'status' => true ]);
        
    }

    public function checkInputsType($inputs){

         if(filter_var($inputs['register'],FILTER_VALIDATE_EMAIL)){

            $modelClass = $inputs['guard'] == 'client' ? 'App\Models\Client':'App\Models\Consultant';

            $user = $modelClass::where('email',$inputs['register'])->first();


            if(empty($user)){

                $newUser['email'] = $inputs['register'];

            }

            return ['user' => $user, 'newUser' => $newUser ?? null]; 

        }
        else{


            $error= "شناسه ورودی ایمیل نیست";
                        
            return response()->json(['error' => false ]);
            
        }

    }

    public function createNewUser($contentType,$guard){

        $newUser['password'] = Hash::make('password');

        $modelClass = $guard == 'client' ? 'App\Models\Client':'App\Models\Consultant';

        $user = $modelClass::create(array_merge($newUser,$contentType));

        return $user;
    }

    public function createUserOtp($client,$guard){

    
        $inputs['token'] = Str::random(60);
        $inputs['otp_code'] = rand(111111,999999);
        $inputs['login_id'] = $client->email;
        $inputs['otpable_id'] = $client->id;
        $inputs['otpable_type'] = $guard == 'client' ? 'App\Models\Client':'App\Models\Consultant';
        $inputs['used'] = 0;
        $inputs['status'] = 1;
        $inputs['type'] = 1;

        $otp = Otp::create($inputs);

        return $otp;
    }

    public function sendOtpCodeToClientEmail($user,$otp){


        $messageServiceSample = new EmailService();

        $details = [
            'title' => 'کد فعال سازی', 
            'body' => "فعال سازی شما:".$otp,
        ];

        $messageServiceSample->setTo($user->email);
        $messageServiceSample->setFrom('dokhtarooone@zaaaanooone.ir','test-project');
        $messageServiceSample->setDetails($details);
        $messageServiceSample->setSubject('کد احراز هویت شما');


        $result = $messageServiceSample->fire();

        return $result;
    
    }

    /** 
     * @bodyParam first_name required string The name of the client. 
     * @bodyParam last_name required string The family of the client.   
     * @bodyParam gender required The gender of the client. Example:0(man),1(woman).
     * @password password required string The password of the client. 
     * @bodyParam password_confirmation required confirmation of The password of the client. 
     * @bodyParam mobile required mobile of of the client. 
     * @bodyParam email nullable email of of the client. 
    */

    public function completeInfoClient(RegisterCompleteClientRequest $request){

        $inputs = $request->validated();

        Client::find(auth()->user()->id)->update(array_merge($inputs,['password' => Hash::make($inputs['password'])]));

        return response()->json(['error' => true , 'response' => 'اطلاعات جدید افزوده شد']);
    }

     /** 
     * @bodyParam first_name required string The name of the consultant. 
     * @bodyParam last_name required string The family of the consultant.   
     * @bodyParam gender required The gender of the consultant. Example:0(man),1(woman).
     * @bodyParam password required string The password of the consultant. 
     * @bodyParam password_confirmation required confirmation of The password of the consultant. 
     * @bodyParam mobile required mobile of of the consultant. 
     * @bodyParam email nullable email of of the consultant. 
     * @bodyParam profile_photo_path nullable photo_add of of the consultant. 
     * @bodyParam gmc_number required unique code of the consultant. 
    */
    
    public function completeInfoConsaltant(RegisterCompeleteConsultantRequest $request){

        $inputs = $request->validated();

        Consultant::find(auth()->user()->id)->update(array_merge($inputs,['password' => Hash::make($inputs['password'])]));

        return response()->json(['error' => true , 'response' => 'اطلاعات جدید افزوده شد']);
    }


}
