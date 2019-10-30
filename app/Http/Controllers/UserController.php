<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Hash;
use Validator;
/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = \App\User::orderBy('id','desc')->paginate(4);
        return view('users.list')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => 'required|string|max:255|unique:users',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required|string|same:password',
        ];

        $messages = [
            'name.unique'         => trans('users.messages.userNameTaken'),
            'name.required'       => trans('users.messages.userNameRequired'),
            'email.required'      => trans('users.messages.emailRequired'),
            'email.email'         => trans('users.messages.emailInvalid'),
            'password.required'   => trans('users.messages.passwordRequired'),
            'password.min'        => trans('users.messages.PasswordMin'),
            'password.max'        => trans('users.messages.PasswordMax'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = \App\User::create([
            'name'             => $request->input('name'),
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
        ]);

        return redirect('users')->with('success', trans('users.messages.user-creation-success'));
    }

    /**
     * Display the specified user.
     *
     * @param  string  $locale
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $id)
    {
        return $this->edit($locale, $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $locale
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $user = \App\User::findOrFail($id);
        return view('users.edit')->with(['user'=>$user,'locale'=>$locale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $locale
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale, $id)
    {
        $user = \App\User::find($id);
        $emailCheck = ($request->input('email') !== '') && ($request->input('email') !== $user->email);
        $passwordCheck = $request->input('password') !== null;

        $rules = [
            'name'                  => 'required|max:255',
        ];

        if ($emailCheck) {
            $rules['email'] = 'required|email|max:255|unique:users';
        }

        if ($passwordCheck) {
            $rules['password'] = 'required|string|min:6|max:20|confirmed';
            $rules['password_confirmation'] = 'required|string|same:password';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($passwordCheck) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return back()->with('success', trans('users.messages.update-user-success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $locale
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($locale, $id)
    {
        $currentUser = Auth::user();
        $user = \App\User::findOrFail($id);

        if ($currentUser->id !== $user->id) {
            $user->delete();

            return redirect($locale.'/users')->with('success', trans('users.messages.delete-success'));
        }

        return back()->with('error', trans('users.messages.cannot-delete-yourself'));
    }
}
