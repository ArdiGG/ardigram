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
            now()->addSecond(10),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = $this->followersCount($user);

        $followingCount = $this->followingCount($user);

        return view('profiles.show', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function show_replies(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts' . $user->id,
            now()->addSecond(10),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = $this->followersCount($user);

        $followingCount = $this->followingCount($user);

        return view('profiles.show_replies', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function followers(User $user)
    {
        $followers = $user->profile->followers;

        $followersCount = $this->followersCount($user);

        $followingCount = $this->followingCount($user);

        return view('profiles.followers', compact('user','followers', 'followersCount', 'followingCount'));
    }

    public function following(User $user)
    {

        $following = $user->following;

        $followersCount = $this->followersCount($user);

        $followingCount = $this->followingCount($user);

        return view('profiles.following', compact('user','following','followingCount','followersCount'));
    }

    public function followingCount(User $user)
    {
        $followingCount = Cache::remember(
            'count.following' . $user->id,
            now()->addSecond(10),
            function () use ($user) {
                return $user->following->count();
            });

        return $followingCount;
    }

    public function followersCount(User $user)
    {
        $followersCount = Cache::remember(
            'count.followers' . $user->id,
            now()->addSecond(10),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        return $followersCount;
    }

    public function showPeople()
    {
        $users = User::inRandomOrder()->get();

        return view('profiles.people', compact('users'));
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
