<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

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
            'profile_picture' => [
                    'image',
                    'dimensions:min_width=250,min_height=250,'.
                        'max_width=5000,max_height=5000',
            ],
            'remove_profile_picture' => '',
        ]);

        if ( $request->has('profile_picture')) {
            $request_file = $request->file('profile_picture');

            $image_path = '/storage/'.$request_file->storeAs(
                'profile_pictures',
                "{$this->user->id}.{$request_file->extension()}",
                'public',
            );

            $image = Image::make(public_path($image_path))
                ->fit(1000, 1000);
            $image->save();

            $validate_data = array_merge(
                $validate_data, ['profile_picture' => $image_path]
            );
        } else if ( $request->has('remove_profile_picture') ) {
            unset($validate_data['remove_profile_picture']);
            $validate_data = array_merge(
                $validate_data, ['profile_picture' => null]
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
