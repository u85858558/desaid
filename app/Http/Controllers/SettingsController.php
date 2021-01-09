<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @property  user
 */
class SettingsController extends Controller
{
    public function __construct()
    {
        //bind $this->user to the authenticated user
        $this->middleware(function ($request, $next) {
           $this->user = auth()->user();

           return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('settings.edit', ['user' => $this->user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $validate_data = $request->validate([
            'username' => [
                'required',
                'unique:users,username,' .$this->user->id,
                'alpha_dash',
            ],
            'description' => '',
            'profile_picture' => 'demensions:min_width=250,min_height=250,'
                .'max_width=5000,max=_height=5000',
        ]);

        if ( $request->has('picture')) {
            $image_path = $request->image->store(
                "profile_pictures/{$this->user->id}", 'public'
            );

            $image = Image::make(public_path("storage/{$image_path}"))
                ->fit(1000, 1000);
            $image->save();

            $validate_data = array_merge(
                $validate_data, ['profile_picture' => $image_path]
            );
        }

        $user_data = ['username' => $validate_data['username']];

        unset($validate_data['username']);

        $this->user->profile->update($validate_data);
        $this->user->update($user_data);

        return redirect('settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}