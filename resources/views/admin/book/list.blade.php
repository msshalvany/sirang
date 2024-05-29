@extends('admin.layout.layout')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" style="margin-top: 120px" role="alert">
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
                <th>تیتراژ</th>
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->page_count }}</td>
                    <td>
                        <a href="{{ route('bookEdit', ['book' => $book->id]) }}" class="btn btn-outline-primary">ویرایش</a>
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{$book->id}}">
                            حذف
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$book->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{$book->id}}">تأیید حذف کتاب</h5>
                                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        آیا مطمئن هستید که می‌خواهید این کتاب را حذف کنید؟
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                                        <form action="{{ route('bookDel', ['book' => $book->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
