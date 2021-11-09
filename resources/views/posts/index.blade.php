@extends('layouts.app')

@section('content')

    <div class="container">
        @if($posts->count() != 0)
            @foreach($posts as $post)
                <div class="row offset-2">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="/profile/{{$post->user->id}}" style="text-decoration: none; color:black">
                                <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100"
                                     style="max-width: 40px" alt="">
                            </a>
                        </div>
                        <div class="p-lg-3">
                        <span class="fw-bold">
                            <a href="/profile/{{$post->user->id}}"
                               style="text-decoration: none; color:black">{{$post->user->username}}</a>
                        </span>
                            <a href="#" style="text-decoration: none" class="p-lg-3">Follow</a>
                        </div>
                    </div>
                    <div class="col-8">
                        <a href="/p/{{$post->id}}">
                            <img src="/storage/{{$post->image}}" alt="" class="w-100">
                        </a>
                    </div>
                </div>
                <div class="row offset-2">
                    <div class="col-8 pt-2">

                        <p>
                    <span class="fw-bold">
                        <a href="/profile/{{$post->user->id}}" style="text-decoration: none; color:black">
                            <span>{{$post->user->username}}</span>
                        </a>
                    </span> {{$post->caption}}
                        </p>
                        <hr>

                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12">
                    {{$posts->links("pagination::bootstrap-4")}}
                </div>
            </div>

        @else
            <h2>Новостей пока нет</h2>
        @endif
    </div>
@endsection
