<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // جلب جميع المدونات
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    // تخزين مدونة جديدة
    public function store(Request $request)
    {
        // التحقق من صحة البيانات مع رسائل مخصصة
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'imgSrc' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048',
        ], [
            'title.required' => 'يرجى إدخال عنوان المدونة.',
            'content.required' => 'يرجى إدخال محتوى المدونة.',
            'imgSrc.required' => 'يرجى تحميل صورة.',
            'imgSrc.image' => 'يجب أن تكون الصورة من نوع صورة.',
            'imgSrc.mimes' => 'يجب أن تكون الصورة من نوع: jpg، jpeg، png، bmp.',
            'imgSrc.max' => 'يجب ألا تتجاوز الصورة 2 ميغابايت.',
        ]);

        // تخزين الصورة
        $path = $request->file('imgSrc')->store('images', 'public');

        // إنشاء سجل جديد مع مسار الصورة
        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'imgSrc' => $path,
        ]);

        return response()->json($blog, 201);
    }

    // تحديث مدونة موجودة
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'لم يتم العثور على المدونة'], 404);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'imgSrc' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048',
        ], [
            'title.string' => 'يجب أن يكون العنوان نصًا.',
            'imgSrc.image' => 'يجب أن تكون الصورة من نوع صورة.',
            'imgSrc.mimes' => 'يجب أن تكون الصورة من نوع: jpg، jpeg، png، bmp.',
            'imgSrc.max' => 'يجب ألا تتجاوز الصورة 2 ميغابايت.',
        ]);

        // تحديث الحقول الأخرى
        if ($request->filled('title')) {
            $blog->title = $request->title;
        }

        if ($request->filled('content')) {
            $blog->content = $request->content;
        }

        // إذا كانت الصورة موجودة، قم بتخزينها
        if ($request->hasFile('imgSrc')) {
            // حذف الصورة القديمة
            Storage::disk('public')->delete($blog->imgSrc);
            // تخزين الصورة الجديدة
            $path = $request->file('imgSrc')->store('images', 'public');
            $blog->imgSrc = $path; // تحديث مسار الصورة
        }

        // حفظ التغييرات
        $blog->save();

        return response()->json($blog);
    }

    // حذف مدونة
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'لم يتم العثور على المدونة'], 404);
        }

        // حذف الصورة من التخزين قبل حذف المدونة
        Storage::disk('public')->delete($blog->imgSrc);

        // حذف المدونة
        $blog->delete();

        return response()->json(['message' => 'تم حذف المدونة بنجاح']);
    }
}
