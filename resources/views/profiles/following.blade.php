@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @foreach($following as $user)
                <div class="col-4  pt-4">
                    <img src="{{$user->profileImage()}}" class="rounded-circle" style="max-width: 50px" alt="">  <strong style="padding-left: 10px">{{$user->user->username}}</strong>
                </div>
                <div class="pt-2">
                    <hr>
                </div>
            @endforeach
        </div>

    </div>
@endsection
