@extends('book.layout.layout')

@section('content')
    <ul class="nav nav-pills fixed-top bg-light m-2 p-2 ">
        <li class="nav-item">
            <a class="nav-link active" href="#">رفتن به ناحیه کاربری</a>
        </li>
    </ul>
    <div class="w-100 ">
        <div class="card mx-auto" style="width: 300px; margin-top: 20vh">
            <div class="card text-center">
                <div class="card-header">
                    {{$book->title}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">نویسنده : {{$book->author }}</h5>
                    <p class="card-text">ناشر : {{$book->publisher}}</p>
                    <p class="card-text">تیتراژ : {{$book->page_count}}</p>
                    <form action="{{route('borrowBook',['book'=>$book->id])}}" method="post">
                        @csrf
                        <input class="btn btn-primary" type="submit" value="امانت گرفتن">
                    </form>
                    <div class="mt-2">
                        <strong class="text-danger">فقط هفت روز میتوانبد امانت بگیرید</strong>
                    </div>
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                            <strong>{{session()->get('error')}}</strong>
                            <button type="button" class="close btn btn-close float-end" data-dismiss="alert"
                                    aria-label="Close">
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
@endsection
