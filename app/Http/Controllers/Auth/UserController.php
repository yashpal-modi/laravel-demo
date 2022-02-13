<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Carbon\Carbon;
  
class UserController extends Controller
{    
    /**
     * load login page
     *
     * @return response()
     */
    public function index()
    {
        if(Auth::check()){
            $userData = auth()->user();
            return view('dashboard', ["userData" => $userData]);
        }
        return view('auth.login');
    }  
      
    /**
     * Load registration page
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * after login page
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You are login successfully');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * after registration page
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'date_of_birth' => 'required',
            'address' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")
                ->with('flash_message', 'You are registration succssfully.')
                ->with('flash_type', 'alert-success');
    }
    
    /**
     * Load dashboard page
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            $userData = auth()->user();
            return view('dashboard', ["userData" => $userData]);
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Insert record on registration
     *
     * @return response()
     */
    public function create(array $data)
    {
        $getBirthDate = Carbon::createFromFormat('d-m-Y', $data['date_of_birth'])->format('Y-m-d');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'last_name' => $data['last_name'],
            'date_of_birth' => $getBirthDate,
            'address' => $data['address'],
        ]);
      
        return redirect("login")->withSuccess('You are register successfully');
    }
    
    /**
     * Update records of user data
     *
     * @return response()
     */
    public function updateUser(Request $request, $id){
        $updateData = $request->validate([
                        'name' => 'required',
                        'last_name' => 'required',
                        'date_of_birth' => 'required',
                        'address' => 'required',
                    ]);

        $getBirthDate = Carbon::createFromFormat('d-m-Y', $request['date_of_birth'])->format('Y-m-d');
        $updateData['date_of_birth'] = $getBirthDate;

        User::whereId($id)->update($updateData);
        return redirect('dashboard')->withSuccess('Data has been updated successfully');
    }
    
    /**
     * Logout page
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}