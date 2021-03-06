@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/settings" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Edit Profile</h1>
                    </div>

                    @if( Session::has('status') )
                        <div class="alert alert-success">
                            {{ Session::get('status') }}
                        </div>
                    @endif
                    <div class="p-5">
                        <img
                            src="{{ $user->profile->profile_picture }}"
                            class="rounded-circle w-50"
                        >
                    </div>

                    {{-- checkbox if to remove profile_picture --}}
                    <div class="row">
                        <label for="remove_profile_picture">
                            delete profile picture
                        </label>
                        <input type="checkbox" name="remove_profile_picture">
                    </div>

                    {{-- change profile_picture --}}
                    <div class="row pb-3">
                        <label for="profile_picture"
                               class="com-md-4 col-form-label"
                        >
                            profile picture
                        </label>
                        <input name="profile_picture"
                               type="file" class="form-control-file"
                               id="profile_picture"
                        >

                        @error('profile_picture')
                            <strong>
                                {{ $errors->first('profile_picture') }}
                            </strong>
                        @enderror
                    </div>

                    {{-- change username --}}
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label">
                            username
                        </label>

                        <input id="username" type="text"
                               class="form-control
                                       @error('username') is-invalid @enderror"
                               name="username"
                               value="{{old('username') ?? $user->username}}"
                               autocomplete="username" autofocus
                        >

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>
                                    {{ $error->first('username') }}
                                </strong>
                            </span>
                        @enderror
                    </div>

                    {{-- change description --}}
                    <div class="row">
                        <label for="description"class="col-md-4 col-form-label">Description</label>

                        <input id="description" type="text"
                                class="form-control
                                        @error('description') is-invalid @enderror"
                               name="description"
                               value="{{old('description') ??
                               $user->profile->description }}"
                               autocomplete="description" autofocus
                        >

                        @error('description')
                            <strong>
                                {{ $error->first('description') }}
                            </strong>
                        @enderror
                    </div>

                    <div class="row pt-4">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
