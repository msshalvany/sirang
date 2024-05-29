@extends('admin.layout.layout')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" style="margin-top: 120px"
             role="alert">
            <strong>{{session()->get('message')}}</strong>
            <button type="button" class="close btn btn-close float-end" data-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>`
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show w-75 mx-auto" style="margin-top: 120px" role="alert">
            <strong>{{session()->get('error')}}</strong>
            <button type="button" class="close btn btn-close float-end" data-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>`
    @endif
    <div class="w-100" style="margin-top: 120px">
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        @if ($books->hasPages())
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($books->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">«</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->appends(request()->input())->previousPageUrl() }}"
                               rel="prev" aria-label="@lang('pagination.previous')">«</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @if ($books->currentPage() > 3)
                        <li class="page-item"><a class="page-link"
                                                 href="{{ $books->appends(request()->input())->url(1) }}">1</a></li>
                    @endif
                    @if ($books->currentPage() > 4)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @foreach (range(1, $books->lastPage()) as $i)
                        @if ($i >= $books->currentPage() - 2 && $i <= $books->currentPage() + 2)
                            @if ($i == $books->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link"
                                                         href="{{ $books->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    @if ($books->currentPage() < $books->lastPage() - 3)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @if ($books->currentPage() < $books->lastPage() - 2)
                        <li class="page-item"><a class="page-link"
                                                 href="{{ $books->appends(request()->input())->url($books->lastPage()) }}">{{ $books->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($books->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->appends(request()->input())->nextPageUrl() }}"
                               rel="next" aria-label="@lang('pagination.next')">»</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">»</span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif


        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}


        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>عنوان</th>
                <th>نویسنده</th>
                <th>ناشر</th>
                <th>تیتراژ</th>
                <th>نام کاربر</th>
                <th>زمان باقی مانده</th>
                <th>تاریخ امانت - انتضا</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    @php
                        //زمان باقی مانده تا پایان
                        $today = \Carbon\Carbon::now();
                        $inputDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $book->due_date);
                        $remainingHours = $inputDate->diffInHours($today, false); // محاسبه ساعات باقی‌مانده
                        $daysRemaining = floor($remainingHours / 24);
                        $hoursRemaining = $remainingHours % 24;
                          //زمان باقی مانده تا پایان

                        // تاریخ های مورد نیاز با شمسی

                        // تاریخ‌های مورد نیاز با شمسی
                        $borrowed_at = verta( new Datetime($book->borrowed_at));
                        $due_date = verta(new Datetime($book->due_date));
                        // تاریخ های مورد نیاز با شمسی


                        $user = \App\Models\User::find($book->user_id);
                        $book = \App\Models\Book::find($book->book_id);
                    @endphp
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->page_count }}</td>
                    <td>{{$user->username}}</td>
                    <td>
                        @if($inputDate->isFuture())
                            @php
                                $remainingHours = $inputDate->diffInHours($today, false); // محاسبه ساعات باقی‌مانده
                                $daysRemaining = floor($remainingHours / 24);
                                $hoursRemaining = $remainingHours % 24;
                            @endphp
                            باقی‌مانده: {{$daysRemaining}} روز و {{$hoursRemaining}} ساعت
                        @else
                            مهلت امانت تمام شده
                        @endif
                    </td>
                    <td>
                        شروع : {{$borrowed_at}}
                        پایان : {{$due_date}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        @if ($books->hasPages())
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{-- Previous Page Link --}}
                    @if ($books->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">«</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->appends(request()->input())->previousPageUrl() }}"
                               rel="prev" aria-label="@lang('pagination.previous')">«</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @if ($books->currentPage() > 3)
                        <li class="page-item"><a class="page-link"
                                                 href="{{ $books->appends(request()->input())->url(1) }}">1</a></li>
                    @endif
                    @if ($books->currentPage() > 4)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @foreach (range(1, $books->lastPage()) as $i)
                        @if ($i >= $books->currentPage() - 2 && $i <= $books->currentPage() + 2)
                            @if ($i == $books->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link"
                                                         href="{{ $books->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    @if ($books->currentPage() < $books->lastPage() - 3)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @if ($books->currentPage() < $books->lastPage() - 2)
                        <li class="page-item"><a class="page-link"
                                                 href="{{ $books->appends(request()->input())->url($books->lastPage()) }}">{{ $books->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($books->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->appends(request()->input())->nextPageUrl() }}"
                               rel="next" aria-label="@lang('pagination.next')">»</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">»</span>
                        </li>
                    @endif
                </ul>
            </nav>
        @endif


        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
        {{--        ================ paginatetion========================     --}}
    </div>
@endsection
