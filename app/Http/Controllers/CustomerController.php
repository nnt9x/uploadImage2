<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // GET: /
    function viewIndex()
    {
        // Lấy dữ liệu trong DB và trả về view
        $customers = DB::table('customers')->get();
        return view('index', ['customers' => $customers]);
    }

    // POST: thêm khách hàng
    function create(Request $request)
    {
        $full_name = $request->get('full_name');
        $phone = $request->get('phone', '');
        $email = $request->get('email', '');
        $dob = $request->get('dob');
        // Ok dã có dữ liệu
        $avatar_file = $request->file('avatar_file');
        if ($avatar_file != null) {
            // Lấy ra tên file + đuôi mở rộng
            $newNameFile = time() . "" . $avatar_file->getClientOriginalName();
            // Di chuyển file vừa up vàp stoge -> rename
            $avatar_url = $avatar_file->storeAs('images', $newNameFile, 'public');
            // Lấy ra đường dẫn
            $avatar_url = "storage/" . $avatar_url;
        }
        // Luu du lieu khach hang vao db
        $rs = DB::table('customers')->insert([
            'full_name' => $full_name,
            'phone' => $phone,
            'email' => $email,
            'dob' => $dob,
            'avatar_url' => $avatar_url,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if ($rs == false) {
            dd("Thất bại!");
        }
        // Chuyen huong nguoc ve request truoc do
        return redirect()->back();

    }

    function delete(Request $request)
    {
        $customer_id = $request->get('customer_id');
        // Xoa
        $rs = DB::table('customers')->delete($customer_id);
        if ($rs == 0) {
            dd("Thất bại!");
        }
        return redirect()->back();

    }
}

