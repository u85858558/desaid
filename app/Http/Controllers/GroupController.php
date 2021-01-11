<?php

namespace App\Http\Controllers;

use App\Group;
use \Illuminate\Http\Request;

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
    {}

    public function show(Group $group)
    {}

    public function edit(Group $group)
    {}

    public function update(Request $request, Group $group)
    {}

    public function destroy(Group $group)
    {}
}
