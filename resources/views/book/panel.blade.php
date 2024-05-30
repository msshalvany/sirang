@extends('book.layout.layout')

@section('content')
    <div class="container">
        <h2 class="text-center" style="margin-top: 100px">لیست کتاب های به امانت گرفته شما</h2>
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show mt-5 w-75 m-auto" role="alert">
                <strong>{{session()->get('message')}}</strong>
                <button type="button" class="close btn btn-close float-end" data-dismiss="alert"
                        aria-label="Close">
                </button>
            </div>
        @endif
        @foreach ($books as $book)
            @php
                $today = \Carbon\Carbon::now();
                $inputDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $book->due_date);
            @endphp
            <div class="m-auto   mt-5" style="min-width: 320px;width: 80%">
                <div class="card">
                    <div class="card-body">
                        @php
                            $book = \App\Models\Book::find($book->book_id); //گرفتن داده های کامل
                        @endphp
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <pre class="card-text">نویسنده : {{ $book->author }}</pre>
                        <pre class="card-text">ناشر : {{ $book->publisher }}</pre>
                        <pre class="card-text">نویسنده : {{ $book->page_count }}</pre>
                    </div>
                    <span class="badge rounded-pill text-bg-danger w-25 p-2 m-2">
                        @if($inputDate->isFuture())
                            @php
                                $remainingHours = $inputDate->diffInHours($today, false); // محاسبه ساعات باقی‌مانده
                                $daysRemaining = floor($remainingHours / 24);
                                $hoursRemaining = $remainingHours % 24;
                            @endphp
                            باقی‌مانده: {{$daysRemaining}} روز و {{$hoursRemaining}} ساعت
                        @else
                            مهلت امانت تمام شده هرچه سریع تر کتاب را به کتابخانه برگرداند
                        @endif
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endsection
