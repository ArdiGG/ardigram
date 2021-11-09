@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row flex-column align-items-center">
            <div class="col-lg-8  pt-4 d-flex">
                <a href="/profile/{{$user->id}}" class="d-flex" style="text-decoration: none;">
                    <img src="/storage/{{$user->profile->image}}" class="rounded-circle" style="max-width: 40px" alt="">
                    <h2 style="padding-left: 5px; color: black;">{{$user->username}}</h2>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-4  pt-4">
                <a href="/profile/{{$user->id}}/followers" style="text-decoration: none; color: black">
                    <h4>{{$followersCount ?? 0 }} followers</h4>
                </a>
            </div>
            <div class="col-4  pt-4">
                <h4 style="text-decoration: underline">{{$followingCount ?? 0}} following</h4>
            </div>
        </div>
        <hr>

        <div class="row">
            @foreach($following as $follower)
                <div class="col-4  pt-4">
                    <img src="{{$follower->profileImage()}}" class="rounded-circle" style="max-width: 50px" alt="">
                    <strong style="padding-left: 10px">{{$follower->user->username}}</strong>
                </div>
                <div class="pt-2">
                    <hr>
                </div>
            @endforeach
        </div>

    </div>
@endsection
