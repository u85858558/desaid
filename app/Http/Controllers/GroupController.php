<?php

namespace App\Http\Controllers;

use App\Group;
use \Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class GroupController extends Controller
{
    public function index()
    {}

    public function create()
    {
        $group = new \App\Group;

        $group->banner_picture = $group->banner_picture;

        return view('groups.create', ['group' => $group]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => [
                'required',
                'unique:groups',
                'alpha_dash',
            ],
            'banner_picture' => [
                'image',
                'dimensions:min_width=250,min_height=250,'.
                    'max_width=5000,max_height=5000',
            ],
            'private' => 'boolean',
            'remove_banner_picture' => 'boolean',
        ]);

        $auth_user = auth()->user();

        if ( $request->has('banner_picture') ) {
            $request_file = $request->file('banner_picture');

            $image_path = '/storage/'.$request_file->store(
                    'banner_pictures'.$auth_user->id,
                    'public',
                );

            $image = Image::make(public_path($image_path))
                ->fit(1500);
            $image->save();

            $validated_data = array_merge(
                $validated_data, ['banner_picture' => $image_path]
            );
        } else if ( $request->has('remove_banner_picture') ) {
            unset($validated_data['remove_banner_picture']);
            $validated_data = array_merge(
                    $validated_data, ['banner_picture' => null]
            );
        }

        $group = new Group($validated_data);
        $group->owner_id = $auth_user->id;
        $group->save();

        return response('Creating successful.', 200);
    }

    public function show(Group $group)
    {}

    public function edit(Group $group)
    {}

    public function update(Request $request, Group $group)
    {}

    public function destroy(Group $group)
    {}
}
