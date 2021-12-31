@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{$user->profile->profileImage()}}"
                     style="border: 1px solid #333333; height: 200px" class="rounded-circle" alt="">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">

                    <div class="d-flex align-items-center">
                        <h2>{{$user->username}}</h2>
                        @can('follow', $user->profile)
                            <follow-button user-id="{{$user->id}}" follows="{{$follows ?? 0}}"></follow-button>
                        @endcan
                    </div>

                    @can('update',$user->profile)
                        <a href="{{route('post.create')}}" style="text-decoration: none">Add New Post</a>
                    @endcan
                </div>
                @can('update',$user->profile)
                    <a href="/profile/{{$user->id}}/edit" style="text-decoration: none;">Edit Profile</a>
                @endcan
                <div class="d-flex">
                    <div class="pe-4"><strong>{{$postCount ?? 0}}</strong> posts</div>
                    <div class="pe-4"><a href="{{route('profile.followers', $user->profile->id)}}"
                                         style="text-decoration: none; color: black"><strong>{{$followersCount ?? 0}}</strong>
                            followers</a></div>
                    <div class="pe-4"><a href="{{route('profile.following', $user->profile->id)}}"
                                         style="text-decoration: none; color: black"><strong>{{$followingCount ?? 0}}</strong>
                            following</a></div>
                </div>
                <div class="pt-4 fw-bold">
                    {{$user->profile->title ?? null}}
                </div>
                <div>{{$user->profile->description ?? null}}</div>
                <div>
                    <a href="#">{{$user->profile->url ?? null}}</a>
                </div>
            </div>
        </div>
        @yield('info')
    </div>

@endsection
