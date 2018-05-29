<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Two\InvalidStateException;
use League\OAuth1\Client\Credentials\CredentialsException;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     *  Create a new controller instance
     * 
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     *  Redirect the user to provider authentication page
     * 
     *  @param  string $driver
     *  @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();        
    }

    /**
     *  Handle provider response
     * 
     *  @param  string $driver
     *  @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {   
        try {
            return $this->handle($driver);
        } catch (InvalidStateException $e) {
            return $this->redirectToProvider($driver);
        } catch (ClientException $e) {
            return $this->redirectToProvider($driver);
        } catch (CredentialsException $e) {
            return $this->redirectToProvider($driver);
        }
    }

    // protected function login($user)
    // {
    //     auth()->login($user);

    //     return redirect()->intended('/');
    // }

    /**
     *  Register the user
     * 
     *  @param  array $user
     *  @return User $user
     */
    protected function register(array $user)
    {
        $password = bcrypt(str_random(10));
        
        $newUser = User::create(array_merge($user, ['password' => $password]));        

        return $newUser;
    }

    public function handle($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            Auth::login($authUser, true);
            return redirect()->intended('/');
        }

        return $this->validateUser($user, $provider);

        
        
    }       

    private function valid($email, $username){
        $input = [
             'email'   => $email,
             'username' => $username
              ];
        $rules = [
                    'email'   => 'unique:users',
                    'username' => 'unique:users'
                    ];
        $messages = [
                        'unique' => 'The :attribute has already been taken'
                        ];
        return Validator::make($input, $rules, $messages);

    }

    public function validateUser($user, $provider){

        $name = explode(" ", $user->name);
        if(sizeof($name) == 1){
            $first_name = $name[0];
            $last_name = "Doe";
            $username = strtolower($first_name);
        }else{
            $first_name = $name[0];
            $last_name = $name[1];
            $username = $name[0].$name[1];
            $username = strtolower($username);
        }

        $validator = $this->valid($user->email, $username);
        if(!$validator->passes())
            return redirect()->back()->with(['errors' => $validator->errors()]);


        

        $authUser = $this->register([
            'username' => $username,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
           
        ]); 

        Auth::login($authUser, true);
        return redirect()->intended('/');

    }
}