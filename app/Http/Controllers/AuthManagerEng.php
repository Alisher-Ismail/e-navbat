<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AuthManagerEng extends Controller
{
    

    function adminlogin(){
        if(Auth::check()){
            return redirect()->intended(route('adminhomeeng'));
        }
        return view('english.login');
    }

    public function adminloginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            // Check if the user's muddat is greater than today's date
            $user = Auth::user();
            $userid = $user->id;
            return redirect()->intended(route('adminhomeeng'));
        }

        return redirect(route('logineng'))->with('error', 'Email or Password Wrong');
    }

    function adminlogout(){
        Session::flush();
        Auth::logout();
        return redirect(route('logineng'));
    }

    //add user
    public function usersuper()
    {   
        $user = auth()->user();
        $userId =  $user->firmaid;
            
        $users = User::where('id', '!=', $userId)->where('type', 'admin')->get();
        return view('english.usersuper', compact('users'));
    }
    
    public function user()
    {   
        $user = auth()->user();
            $userId = 0;
            if($user->type == 'admin'){
                $userId = $user->id;     
            }else{
                $userId = $user->firmaid;
            }
        $users = User::where('firmaid', $userId)->get();
        return view('english.user', compact('users'));
    }

    public function edit($id)
    {
        // Retrieve the specific about section by its ID
        $users = User::findOrFail($id);
        $user2 = auth()->user();
            $userId = 0;
            if($user2->type == 'admin'){
                $userId = $user2->id;     
            }else{
                $userId = $user2->firmaid;
            }
        $user = User::where('firmaid', $userId)->get();
    
        // Pass the about section to the view
        return view('english.useredit', compact('users', 'user'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'ism' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'parol' => 'required|string|min:4',
            'type' => 'required|string|max:255'
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's data
        $user->name = $request->input('ism');
        $user->email = $request->input('email');
        $user->type = $request->input('type');
        // Hash the password before saving it to the database
        $user->password = Hash::make($request->input('parol'));

        // Save the user
        $user->save();

        // Redirect back with a success message
        return redirect()->route('adminusereng')->with('success', 'Successfully Saved.');    }

    public function delete(Request $request, $id)
    {
        // Retrieve the specific about section by its ID
        $user = User::findOrFail($id);

         // Check if the about section exists
         if (!$user) {
            // If the about section does not exist, return a response
            return redirect()->back()->with('error', 'Not Found.');
        }

        // Save the changes to the about section
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('adminusereng')->with('success', 'Deleted.');
        }


        public function store(Request $request)
        {
            $user = auth()->user();
            $userId = 0;
            if($user->type == 'admin'){
                $userId = $user->id;     
            }else{
                $userId = $user->firmaid;
            }
            // Validate the request data
            $validatedData = $request->validate([
                'ism' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'parol' => 'required|string|min:4',
                'type' => 'required|string|max:255'
            ]);
        
            try {

                $userombor = User::where('email', $validatedData['email'])->where('firmaid', $userId)->first();
                if($userombor){
                    return redirect()->back()->withErrors(['error' => 'Change Login']);
                }else{
                // Create a new User model instance and save it to the database
                User::create([
                    'name' => $validatedData['ism'],
                    'email' => $validatedData['email'],
                    'type' => $validatedData['type'],
                    'firmaid' => $userId,
                    'muddat' => $user->muddat,
                    'password' => Hash::make($validatedData['parol']), // Hash the password
                ]);
        
                return redirect()->route('adminusereng')->with('success', 'Successfully Saved.');
            }
            } catch (\Exception $e) {
                // Handle any errors that might occur
                return redirect()->back()->withErrors(['error' => 'Error']);
            }
        }
    //add user
}
