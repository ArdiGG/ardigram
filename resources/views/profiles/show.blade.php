@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{"/storage/" . $user->profile->image ?? "/img/avatar.jpg"}}"
                     style="border: 1px solid #333333; height: 200px" class="rounded-circle" alt="">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h1>{{$user->username}}</h1>
                    @can('update',$user->profile)
                        <a href="{{route('post.create')}}" style="text-decoration: none">Add New Post</a>
                    @endcan
                </div>
                @can('update',$user->profile)
                    <a href="/profile/{{$user->id}}/edit" style="text-decoration: none">Edit Profile</a>
                @endcan
                <div class="d-flex">
                    <div class="pe-4"><strong>{{$user->posts->count()}}</strong> posts</div>
                    <div class="pe-4"><strong>88</strong> followers</div>
                    <div class="pe-4"><strong>107</strong> following</div>
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
        <div class="row">

            @foreach($user->posts as $post)
                <div class="col-4  pt-4">
                    <a href="../p/{{$post->id}}">
                        <img src="/storage/{{$post->image}}" class="w-100">
                    </a>
                </div>
            @endforeach

        </div>

    </div>
@endsection
