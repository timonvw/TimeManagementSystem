<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class GroupsController extends Controller
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
        $groups = Auth::user()->groups;

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:25'],
            'emails' => ['required']
        ]);

        $group = [
            'name' => $request->name,
            'admin_id' => Auth::user()->id
        ];

        $explodedEmails = explode(',', $request->emails);
        $users = collect([]);

        foreach ($explodedEmails as $email)
        {
            $strippedEmail = preg_replace('/\s+/', '', $email);
            $user = User::where('email', $strippedEmail)->first();

            if($user)
            {
                //array_push($finalStrippedEmails, ['user_id' => $userId->id, 'group_id' => 0]);
                if(Auth::user()->email != $strippedEmail)
                {
                    $users->push($user);
                }
                else
                {
                    //Voor als je je eigen email er in zet
                    $validate->errors()->add('emails', "You can't put in your own email");
                    return redirect('groups/create')->withErrors($validate)->withInput();
                }
            }
            else
            {
                //als niet bestaat een error returnen
                $validate->errors()->add('emails', $strippedEmail . " doesn't exist");
                return redirect('groups/create')->withErrors($validate)->withInput();
            }
        }

        $group = Group::create($group);
        // $groupdId = $group->id;

        foreach ($users as $user)
        {
            $group->users()->attach($user);
        }

        $group->users()->attach(Auth::user());

        // for ($i=0; $i < count($finalStrippedEmails); $i++)
        // {
        //     $finalStrippedEmails[$i]['group_id'] = $groupdId;
        // }

        // DB::table('group_user')->insert($finalStrippedEmails);

         // try
            // {
            //     // Validate the value...
            // }
            // catch (Exception $e)
            // {
            //     report($e);
            //     return false;
            // }

        return redirect('/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        if($group->admin_id == Auth::user()->id)
        {
            $times = $group->times;
            return view('groups.show', compact('group','times'));
        }
        else
        {
            return redirect('/groups');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
