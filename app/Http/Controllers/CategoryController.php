<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Nhớ import Model Category vào đây
use Illuminate\Support\Str; // Thêm thư viện Str để tạo slug

class CategoryController extends Controller
{
    // 1. Hiển thị danh sách danh mục
    public function index()
    {
        // Lấy danh sách, sắp xếp theo thời gian mới nhất (hoặc bạn có thể thêm theo id)
        $categories = Category::latest()->get(); 
        return view('admin.category.index', compact('categories'));
    }

    // 2. Hiển thị form thêm mới
    public function create()
    {
        return view('admin.category.create');
    }

    // 3. Lưu danh mục mới vào Database
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'nullable|unique:categories|max:255',
            'icon' => 'nullable|max:255',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        // Tự động tạo slug nếu để trống
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->name);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }

        // Lưu dữ liệu
        Category::create($data);

        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
    }

    // 4. Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Tìm danh mục, nếu không thấy trả về lỗi 404
        return view('admin.category.edit', compact('category'));
    }

    // 5. Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
            'slug' => 'nullable|max:255|unique:categories,slug,' . $id,
            'icon' => 'nullable|max:255',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        // Cập nhật slug
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->name);
        } else {
            $data['slug'] = Str::slug($request->slug);
        }

        $category->update($data);

        return redirect()->route('category.index')->with('success', 'Cập nhật thành công!');
    }

    // 6. Thay đổi trạng thái Ẩn/Hiện
    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        $message = $category->status ? 'Đã hiển thị danh mục!' : 'Đã ẩn danh mục!';
        return redirect()->back()->with('success', $message);
    }
}
