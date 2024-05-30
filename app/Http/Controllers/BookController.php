<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\UserBook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{


    public function bookList()
    {
        $books = Book::paginate(20); // تعداد کتاب‌ها در هر صفحه
        return view('book.bookList', compact('books'));
    }
    public function report ()
    {
        $books = UserBook::paginate(20);
        return view('admin.book.report',compact('books'));
    }
    public function bookSearch(Request $request)
    {
        $query = $request->input('query');
        $books = Book::where('title', 'like', "%$query%")
            ->orWhere('author', 'like', "%$query%")
            ->orWhere('publisher', 'like', "%$query%")
            ->paginate(10);

        return view('book.bookList', compact('books', 'query'));
    }

    public function book(Book $book)
    {
        return view('book.book', compact('book'));
    }


    public function borrowBook(Book $book)
    {

        $user = Auth::user();
        //چک کردن وجود و به امانت گرفته نشدن کتاب
        if (UserBook::where('book_id', $book->id)->where('due_date', '>', Carbon::now())->exists()){
            return redirect()->back()->with('error', 'ین کتاب قبلا به امانت کرفته شده');
        }
        $userBook = new UserBook();
        $userBook->user_id = $user->id; // شناسه کاربر لاگین شده
        $userBook->book_id = $book->id;
        $userBook->borrowed_at = now(); // تاریخ و زمان امانت گیری
        $userBook->due_date = now()->addDays(7); // تاریخ و زمان پایان مهلت امانت گیری (مثلا 7 روز بعد)
        $userBook->save();
        // به‌روزرسانی وضعیت کتاب به "امانت گرفته شده"
        return  redirect()->route('panel')->with(['message'=>'کتاب با موفقیت به امانت گرفته شد به کتابخانه در اسرع وقت مراجعه و کتاب را دریافت کنید.']);
    }
    public function bookListAdmin()
    {
        $books = Book::orderBy('created_at','desc')->paginate(20); // تعداد کتاب‌ها در هر صفحه
        return view('admin.book.list', compact('books'));
    }
    public function bookAdd()
    {
        return view('admin.book.add');
    }
    public function bookInsert(Request $request)
    {
        // ولیدیشن فیلدهای فرم
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'page_count' => 'required|integer|min:1',
        ]);

        // ایجاد کتاب جدید با اطلاعات ورودی
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->page_count = $request->page_count;
        $book->save();

        // بازگشت به صفحه‌ی قبلی یا هر صفحه‌ای که می‌خواهید
        return redirect()->route('bookListAdmin')->with('message', 'کتاب با موفقیت افزوده شد.');
    }
    public function bookDel(Book $book)
    {
        // بررسی آیا کتاب در حال حاضر در امانت است
        $isBookInLoan = UserBook::where('book_id', $book->id)->where('due_date', '>', Carbon::now())->exists();

        // اگر کتاب در حال حاضر در امانت است، نمایش پیام خطا
        if ($isBookInLoan) {
            return redirect()->route('bookListAdmin')->with('error', 'کتاب در حال حاضر توسط کاربر  امانت گرفته شده است.');
        }

        // در غیر این صورت، کتاب را حذف کنید
        $book->delete();
        return redirect()->route('bookListAdmin')->with('message', 'کتاب با موفقیت حذف شد.');
    }

    public function bookEdit(Book $book)
    {
        return view('admin.book.edit',compact('book'));
    }
    public function bookUpdate(Request $request,Book $book)
    {
        // ولیدیشن فیلدهای فرم
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'page_count' => 'required|integer|min:1',
        ]);

        // به‌روزرسانی اطلاعات کتاب
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->page_count = $request->page_count;
        $book->save();
        // بازگشت به صفحه‌ی قبلی یا هر صفحه‌ای که می‌خواهید
        return redirect()->route('bookListAdmin')->with('message', 'اطلاعات کتاب با موفقیت به‌روزرسانی شد.');
    }
}
