<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\StudentModel; //model
use Illuminate\Validation\Rule;
use App\Models\CardModel; //model

class CardController extends Controller
{

    public function index(){
        Paginator::useBootstrap(); // ใช้ Bootstrap pagination
        $cards = CardModel::orderBy('id', 'desc')->paginate(5); //order by & pagination
         //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('cards.list', compact('cards'));
    }

    public function adding() {
        return view('cards.create');
    }


public function create(Request $request)
{
    //msg
    $messages = [
        'card_name.required' => 'กรุณากรอกชื่อ',
        'card_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'card_code.required' => 'กรุณากรอก รหัสนศ',
        'card_code.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'card_code.unique' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'card_phone.required' => 'กรุณากรอก เบอร์ ',
        'card_phone.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',

        'card_img.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
        'card_img.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
    ];

    //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
    $validator = Validator::make($request->all(), [
        'student_name' => 'required|min:3',
        'student_phone' => 'required|min:10',
        'student_code' => 'required|integer|min:1',
        'student_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);
    

    //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
    if ($validator->fails()) {
        return redirect('student/adding')
            ->withErrors($validator)
            ->withInput();
    }


    //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/student
    try {
        $imagePath = null;
        if ($request->hasFile('student_img')) {
            $imagePath = $request->file('student_img')->store('uploads/student', 'public');
        }

        //insert เพิ่มข้อมูลลงตาราง
        StudentModel::create([
            'student_name' => strip_tags($request->student_name),
            'student_phone' => strip_tags($request->student_phone),
            'student_code' => strip_tags($request->student_code),
            
            'student_img' => $imagePath,
        ]);

        //แสดง sweet alert
        Alert::success('Insert Successfully');
        return redirect('/student');

    } catch (\Exception $e) {  //error debug
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('errors.404');
    }
} //create 

public function edit($id)
    {
        try {
            $student = StudentModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($student)) {
                $id = $student->id;
                $student_name = $student->student_name;
                $student_code = $student->student_code;
                $student_phone = $student->student_phone;
            
                $student_img = $student->student_img;
                return view('cards.edit', compact('id', 'student_name', 'student_code', 'student_phone', 'student_img'));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit

public function update($id, Request $request)
{

    //error msg
     $messages = [
        'student_name.required' => 'กรุณากรอกชื่อ',
        'student_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'student_code.required' => 'กรุณากรอก รหัสนศ',
        'student_code.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'student_code.unique' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'student_phone.required' => 'กรุณากรอก เบอร์ ',
        'student_phone.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'student_phone.max' => 'ต้องมีอย่างน้อย :max ตัวอักษร',

        'student_img.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
        'student_img.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
    ];


    // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
    $validator = Validator::make($request->all(), [
        'student_code' => [
                        'required',
                        'min:3' ,
                            Rule::unique('tbl_student','student_code')->ignore($id,'id')],

        'student_name' => 'required|min:3',
       
        'student_phone' => 'required|min:10|max:10',
        'student_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);

    // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
    if ($validator->fails()) {
        return redirect('student/' . $id)
            ->withErrors($validator)
            ->withInput();
    }

    try {
        // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
        $student = StudentModel::findOrFail($id);

        // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
        if ($request->hasFile('student_img')) {
            // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
            if ($student->student_img) {
                Storage::disk('public')->delete($student->student_img);
            }
            // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/student' ใน disk 'public'
            $imagePath = $request->file('student_img')->store('uploads/student', 'public');
            // อัปเดต path รูปภาพใหม่ใน model
            $student->student_img = $imagePath;
        }

        // อัปเดตชื่อสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $student->student_name = strip_tags($request->student_name);
        // อัปเดตรายละเอียดสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $student->student_code = strip_tags($request->student_code);
        // อัปเดตราคาสินค้า
        $student->student_phone = strip_tags($request->student_phone);

        // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
        $student->save();

        // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
        Alert::success('Update Successfully');

        // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
        return redirect('/student');

    } catch (\Exception $e) {
       return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        return view('errors.404');

         //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        //return view('errors.404');
    }
} //update  



public function remove($id)
{
    try {
        $student = StudentModel::find($id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

        if (!$student) {   //ถ้าไม่มี
            Alert::error('student not found.');
            return redirect('student');
        }

        //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
        if ($student->student_img && Storage::disk('public')->exists($student->student_img)) {
            Storage::disk('public')->delete($student->student_img);
        }

        // ลบข้อมูลจาก DB
        $student->delete();

        Alert::success('Delete Successfully');
        return redirect('student');

    } catch (\Exception $e) {
        Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
        return redirect('student');
    }
} //remove 



} //class
