@extends('book.layout.layout')

@section('content')
    <ul class="nav nav-pills fixed-top bg-light m-2 p-2 ">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('panel')}}">رفتن به ناحیه کاربری</a>
        </li>
    </ul>
    <div class="container search-container search-container-adjusted">
        <div class="search-box">
            <form class="form-inline my-2 my-lg-0 d-flex" action="{{route('bookSearch')}}" method="get">
                <input class="form-control mr-sm-2" type="search" name="query" placeholder="نام . تیتراژ .نویسنده ......"
                       aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">جستجو</button>
            </form>
        </div>
    </div>
    <div class="w-100">
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
                            <a class="page-link" href="{{ $books->appends(request()->input())->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">«</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @if ($books->currentPage() > 3)
                        <li class="page-item"><a class="page-link" href="{{ $books->appends(request()->input())->url(1) }}">1</a></li>
                    @endif
                    @if ($books->currentPage() > 4)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @foreach (range(1, $books->lastPage()) as $i)
                        @if ($i >= $books->currentPage() - 2 && $i <= $books->currentPage() + 2)
                            @if ($i == $books->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $books->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endif
                    @endforeach
                    @if ($books->currentPage() < $books->lastPage() - 3)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @if ($books->currentPage() < $books->lastPage() - 2)
                        <li class="page-item"><a class="page-link" href="{{ $books->appends(request()->input())->url($books->lastPage()) }}">{{ $books->lastPage() }}</a></li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($books->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->appends(request()->input())->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">»</a>
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
                <th>تعداد صفحات</th>
                <th>مشاهده کتاب</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->page_count }}</td>
                    <td><a href="{{ route('book', ['book' => $book->id]) }}" class="btn btn-outline-primary">مشاهده کتاب</a></td>
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
                            <a class="page-link" href="{{ $books->appends(request()->input())->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">«</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @if ($books->currentPage() > 3)
                        <li class="page-item"><a class="page-link" href="{{ $books->appends(request()->input())->url(1) }}">1</a></li>
                    @endif
                    @if ($books->currentPage() > 4)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @foreach (range(1, $books->lastPage()) as $i)
                        @if ($i >= $books->currentPage() - 2 && $i <= $books->currentPage() + 2)
                            @if ($i == $books->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $books->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endif
                    @endforeach
                    @if ($books->currentPage() < $books->lastPage() - 3)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @if ($books->currentPage() < $books->lastPage() - 2)
                        <li class="page-item"><a class="page-link" href="{{ $books->appends(request()->input())->url($books->lastPage()) }}">{{ $books->lastPage() }}</a></li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($books->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $books->appends(request()->input())->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">»</a>
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
