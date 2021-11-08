<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $postCount = Cache::remember(
            'count.posts' . $user->id,
            now()->addSecond(30),
            function () use ($user) {
                return $user->posts->count();
            });
        $followersCount = Cache::remember(
            'count.followers' . $user->id,
            now()->addSecond(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });
        $followingCount = Cache::remember(
            'count.following' . $user->id,
            now()->addSecond(30),
            function () use ($user) {
                return $user->following->count();
            });

        return view('profiles.show', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function followers(User $user)
    {
        $followers = $user->profile->followers;


        return view('profiles.followers', compact('followers'));
    }

    public function following(User $user)
    {

        $following = $user->following;


        return view('profiles.following', compact('following'));
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


        if (\request('image')) {
            $imagePath = \request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
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
