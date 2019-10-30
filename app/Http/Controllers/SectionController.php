<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Section;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = \App\Section::orderBy('id','desc')->paginate(5);
        return view('sections.list')->with(['sections'=>$sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = \App\User::all();
        return view('sections.create')->with('users',$users);
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
            'name'                  => 'required|string|max:255|unique:sections',
            'description'           => 'required|string|max:1024',
            'logo'                  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $messages = [
            'name.unique'         => trans('sections.messages.NameTaken'),
            'name.required'       => trans('sections.messages.NameRequired'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imageName = md5(time()).'.jpg';
        $image = request()->logo;
        if (!is_null($image) ) {
            if (file_exists($image->getPathname())) {
                $image->move(storage_path('image/'), $imageName);
            } else {
                Session::flash('error', 'Error read file from uploaded directory!!! Delete your Windows System :) ');
                return back()->withInput();
            }
        }

        $section = \App\Section::create([
            'name'             => $request->input('name'),
            'description'      => $request->input('email'),
            'logo'             => $imageName,
        ]);

        return redirect('sections')->with('success', trans('sections.messages.section-creation-success'));
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the section
     *
     * @param  string  $locale
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id)
    {
        $section = \App\Section::findOrFail($id);
        $users = \App\User::all();
        $selected_users = $section->users->mapWithKeys(
            function($item) {
                return [ $item['id'] => $item['name'] ];
            })->toArray();
        return view('sections.edit')->with(
            [
                'section'         => $section,
                'users'           => $users,
                'selected_users'  => $selected_users,
                'locale'          => $locale
            ]
        );
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
        $rules = [
            'name'                  => 'required|string|max:255',
            'description'           => 'required|string|max:1024',
        ];

        $messages = [
            'name.unique'         => trans('sections.messages.NameTaken'),
            'name.required'       => trans('sections.messages.NameRequired'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $section =Section::findOrFail($id);
        $users = request()->input('users');
        $section->users()->sync($users);

        return redirect($locale.'/sections')->with('success', trans('sections.messages.section-creation-success'));
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
        $section = \App\Section::findOrFail($id);

        $section->delete();

        return redirect($locale.'/sections')->with('success', trans('users.messages.delete-success'));
    }
}
