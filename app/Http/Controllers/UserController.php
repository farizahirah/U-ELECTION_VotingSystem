<?php

namespace App\Http\Controllers;

use File;
use App\Models\User;
use App\Mail\SecurityKey;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->paginate(100);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $safeName = null;
        if($request->hasFile('document'))
        {
            $destinationPath = public_path() . '/archieve/user/'.$request->email.'/';
            $doc = $request->file('document');
            $safeName = $doc->getClientOriginalName();
            $doc->move($destinationPath, $safeName);
        }

        $rand_num = rand(1000, 9999); //generate random number for security number

        $key = array('key' => $rand_num);
        $to_email = $request->email;
        // dd($toemail);

        Mail::to($to_email)->send(new SecurityKey($key));

        //hash security_number
        $rand_num = Hash::make($rand_num);

        User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $safeName,
            'programme' => $request->programme,
            'security_number' => $rand_num,
            'role_id' => 2, //automatic become user
            'student_id' => $request->student_id,
        ]);

        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact("user"));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if($request->hasFile('document'))
        {
            if (File::exists(public_path() . '/archieve/user/'.$request->email.'/'.$user->photo)){
                unlink(public_path() . '/archieve/user/'.$request->email.'/'.$user->photo);
            }
            $destinationPath = public_path() . '/archieve/user/'.$request->email.'/';
            $doc = $request->file('document');
            $safeName = $doc->getClientOriginalName();
            $doc->move($destinationPath, $safeName);
            $user->update([ 'photo' => $safeName]);
        }

        if($request->password == '' || empty($request->password)){
            $user->update([
                'name' => $request->full_name,
                'email' => $request->email,
                'programme' => $request->programme,
                'student_id' => $request->student_id,
            ]);
        }else{
            $user->update([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'programme' => $request->programme,
                'student_id' => $request->student_id,
            ]);
        }

        

        return redirect(route('user.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        $sample = User::destroy($id);

        // Redirect to the group management page
        return redirect(route('user.index'));
    }

    public function forgetPassword()
    {
        return view('auth.forgetpw');
    }

    public function fp(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user)
        {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect(route('login'));

        }else{
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    public function forgetSecurityNumber()
    {
        return view('auth.forgetsn');
    }

    public function fsn(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user)
        {
            $rand_num = rand(1000, 9999); //generate random number for security number

            $key = array('key' => $rand_num);
            $to_email = $request->email;
            // dd($toemail);

            Mail::to($to_email)->send(new SecurityKey($key));
            
            //hash security_number
            $rand_num = Hash::make($rand_num);
            
            $user->update([
                'security_number' => $rand_num,
            ]);

            return redirect(route('login'));

        }else{
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    public function adminLogin()
    {
        return view('auth.admin');
    }
}
