@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row col-6">
            <h2>
                Maybe you know these people
            </h2>
        </div>
        <div class="row col-6 pt-4">
            @foreach($users as $user)
                <div class="col-4  pt-4">
                    <a href="/profile/{{$user->id}}" style="color: black" class="text-decoration-none">
                        <img src="{{$user->profile->profileImage()}}" class="rounded-circle" style="max-width: 35px"
                             alt=""> <strong style="padding-left: 5px">{{$user->username}}</strong>
                    </a>
                </div>
                <div class="pt-2">
                    <hr>
                </div>
            @endforeach
        </div>

    </div>
@endsection
