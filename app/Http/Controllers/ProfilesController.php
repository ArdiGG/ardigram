<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function home()
    {
        $user = auth()->user();

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.show', compact('user', 'follows'));
    }

    public function show(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        return view('profiles.show',compact('user','follows'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit',compact('user'));
    }

    public function folowing(User $user)
    {
        $following = $user->profile->following;

        dd($following);

        return view('profiles.following', compact(''));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = \request()->validate([
            'title' => '',
            'description' => '',
            'url' => '',
            'image' => '',
        ]);


        if(\request('image')){
            $imagePath = \request('image')->store('profile','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }


        auth()->user()->profile()->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        return redirect("profile/{$user->id}");
    }
}
