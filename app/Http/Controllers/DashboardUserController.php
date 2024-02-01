<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'users' => User::where('id', auth()->user()->id)->get(),
            'title' => 'Dashboard Page'
            // mengambil data post yang ditulis oleh user yang sedang login
        ];
        return view('dashboard.index', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $dashboard)
    // PENTING
    // mengapa harus $dashboard, karena di routes mengarah ke '/dashboard', sehingga variabel penampungnya harus sama yaitu dashboard
    {
        $data = [
            'user' => $dashboard,
            'title' => 'Edit Profile'
        ];
        return view('dashboard.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $dashboard)
    {
        $rules = [
            'name' => 'required|max:255'
        ];

        if ($request->username != $dashboard->username) {
            $rules['username'] = 'required|unique:users';
        }

        if ($request->email != $dashboard->email) {
            $rules['email'] = 'required|unique:users';
        }
        // agar username dan email tetap bisa disubmit jika tidak diganti

        $validatedData = $request->validate($rules); // memvalidasi data, sama seperti store tapi dirapihkan

        $validatedData['password'] = auth()->user()->password;

        // update data ke db
        User::where('id', $dashboard->id)
            ->update($validatedData);

        // redirect ke halaman posts
        return redirect('/dashboard')->with('success', 'Profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function change(User $user)
    {
        $data = [
            'user' => $user,
            'title' => 'Change Password'
        ];
        return view('dashboard.changepass', $data);
    }

    public function updatepass(Request $request, User $user)
    {
        if (Hash::check($request->get('old_password'), $user->password)) { // urutan check(pw di request, pw di db)
            if (strcmp($request->get('new_password'), $request->get('conf_new_password')) == 0) { // jika sama, returnnya 0
                $rules = [
                    'old_password' => 'required',
                    'new_password' => 'required|min:5',
                    'conf_new_password' => 'required|min:5'
                ];
                $validatedData = $request->validate($rules);

                $user->password = bcrypt($request->get('new_password'));

                $user->save();

                return redirect('/dashboard')->with('success-pw', 'Password has been updated!');
            }
        }
        return redirect('/dashboard')->with('failed-pw', 'Password cannot be updated!');
    }
}
