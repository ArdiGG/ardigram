@extends('layouts.profile')

@section('info')
    <div class="row d-flex justify-content-center">
        <div class="col-2 pt-2" style="padding-left: 100px">
            <a href="/profile/{{$user->id}}">
                <img src="/svg/insta.svg" class="" style="max-width: 50px" alt="">
            </a>
        </div>
        <div class="col-2 pt-2 mb-2" style="padding-left: 60px">
            <a href="#">
                <img src="/svg/reply_active.svg" style="max-width: 50px" alt="">
            </a>
        </div>
        <hr style="margin-top: 10px;">
    </div>
    <div class="row">

        @foreach($user->posts as $post)
            <div class="col-4 pt-5">
                <a href="../p/{{$post->id}}">
                    .
                </a>
            </div>
        @endforeach

    </div>


@endsection
