@extends('admin.layout.layout')

@section('content')
    <div class="mx-auto" style="margin-top: 120px; min-width: 300px; width: 75%;">
        <h2 class="mb-4">افزودن کتاب جدید</h2>
        <form action="{{route('bookUpdate',['book'=>$book->id])}}" method="POST" class="mb-5">
            @csrf
            @method('PUT')
            <div class="form-group mt-3">
                <label for="title">عنوان</label>
                <div>
                    <input type="text" class="form-control mt-3" id="title" name="title" value="{{$book->title}}" required>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="author">نویسنده</label>
                <div>
                    <input type="text" class="form-control mt-3" id="author" name="author" value="{{$book->author}}" required>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="publisher">ناشر</label>
                <div>
                    <input type="text" class="form-control mt-3" id="publisher" name="publisher" value="{{$book->publisher}}" required>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="page_count ">تیتراژ</label>
                <div>
                    <input type="number" class="form-control mt-3" id="page_count" name="page_count" value="{{$book->page_count}}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">ویرایش</button>
        </form>
    </div>

@endsection
