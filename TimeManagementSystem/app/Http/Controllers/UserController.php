<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        return redirect('/user/'.Auth::user()->id."/edit");
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if($id == $user->id)
        {
            $created = $user->created_at->toDateString();
            return view('account', compact('user', 'created'));
        }
        else
        {
            return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $user = Auth::user();

        if(request()->has('updateUser'))
        {
            $user->update($request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
            ]));
        }
        if(request()->has('updatePassword'))
        {
            $validate = $request->validate([
                'password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8'],
                'new_password_repeat' => ["in:".$request->new_password]
            ]);

            $current_password = Auth::User()->password;

            if(Hash::check($request->password, $current_password))
            {
                $user->update([
                    'password' => Hash::make($request->new_password)
                ]);
            }
        }

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = Auth::user();

        $user->deleting($user);
        Auth::logout();

        if ($user->delete())
        {
            return redirect('/login');
        }
    }
}
