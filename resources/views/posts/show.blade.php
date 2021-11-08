@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{$post->image}}" alt="" class="w-100">
            </div>
            <div class="col-4">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100"
                             style="max-width: 40px" alt="">
                    </div>
                    <div class="p-lg-3">
                        <span class="fw-bold">
                            <a href="/profile/{{$post->user->id}}" style="text-decoration: none; color:black">{{$post->user->username}}</a>
                        </span>
                        <a href="#" style="text-decoration: none" class="p-lg-3">Follow</a>
                    </div>
                </div>

                <hr>

                <p>
                    <span class="fw-bold">
                        <a href="/profile/{{$post->user->id}}" style="text-decoration: none; color:black">
                            <span>{{$post->user->username}}</span>
                        </a>
                    </span> {{$post->caption}}
                </p>
            </div>
        </div>
    </div>
@endsection
