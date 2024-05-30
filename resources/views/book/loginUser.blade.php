@extends('book.layout.layout')
@section('css')
    .nav-pills{
        display:none;
    }
@endsection
@section('content')
    <div class="container-login">
        <h1 class="text-center mb-5">به کتابخانه ملی خوش امدید</h1>
        <div>
            <!-- فرم دوم -->
            <form action="{{route('loginUser')}}" method="post" class="bg-body-tertiary p-4 rounded-5">
                @csrf
                <div class="row gy-1 overflow-hidden">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="username" class="form-control" name="username" id="username"
                                   placeholder="name@example.com" >
                            <label for="email" class="form-label">نام کاربری</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" value=""
                                   placeholder="Password" required>
                            <label for="password" class="form-label">رمز عبور</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid">
                            <button class="btn bsb-btn-2xl btn-primary" type="submit">ورود</button>
                        </div>
                    </div>
                    @if(session()->has('loginErr'))
                        <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                            <strong>نام کاربری یا رمز عبور اشتباه است</strong>
                            <button type="button" class="close btn btn-close float-end" data-dismiss="alert"
                                    aria-label="Close">
                            </button>
                        </div>
                    @endif
                    @error('username')
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close btn btn-close float-end" data-dismiss="alert"
                                aria-label="Close">
                        </button>
                    </div>

                    @enderror
                    @error('passsword')
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close btn btn-close float-end" data-dismiss="alert"
                                aria-label="Close">
                        </button>
                    </div>

                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')

@endsection
