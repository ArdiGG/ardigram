@extends('layouts.profile')

@section('info')
    <div class="row d-flex justify-content-center">
        <div class="col-2 pt-2" style="padding-left: 100px">
            <a href="#">
                <img src="/svg/insta_active.svg" class="" style="max-width: 50px" alt="">
            </a>
        </div>
        <div class="col-2 pt-2 mb-2" style="padding-left: 60px">
            <a href="/profile/{{$user->id}}/replies">
                <img src="/svg/reply.svg" style="max-width: 50px" alt="">
            </a>
        </div>
        <hr style="margin-top: 10px;">
    </div>
    <div class="row">

        @foreach($user->posts as $post)
            <div class="col-4 pt-5">
                <a href="../p/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" class="w-100">
                </a>
            </div>
        @endforeach

    </div>


@endsection
