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
        'card_name.required' => 'กรุณากรอกชื่อการ์ด',
        'card_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'card_number.required' => 'กรุณากรอก รหัสของการ์ด',
        'card_number.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'card_number.unique' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'rarity.required' => 'กรุณากรอก เบอร์ ',
        'rarity.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'set_name.required' => 'กรุณากรอก ชุดของการ์ดนั้น ',
        'card_price.required' => 'กรุณากรอก ราคา ของการ์ดนั้น ',
        'card_img.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
        'card_img.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
    ];

    //rule ตั้งขึ้นว่าจะเช็คอะไรบ้าง
    $validator = Validator::make($request->all(), [
        'card_name' => 'required|min:3',
        'card_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);
    

    //ถ้าผิดกฏให้อยู่หน้าเดิม และแสดง msg ออกมา
    if ($validator->fails()) {
        return redirect('card/adding')
            ->withErrors($validator)
            ->withInput();
    }


    //ถ้ามีการอัพโหลดไฟล์เข้ามา ให้อัพโหลดไปเก็บยังโฟลเดอร์ uploads/student
    try {
        $imagePath = null;
        if ($request->hasFile('card_img')) {
            $imagePath = $request->file('card_img')->store('uploads/card', 'public');
        }

        //insert เพิ่มข้อมูลลงตาราง
        CardModel::create([
            'card_name' => strip_tags($request->card_name),
            'card_number' => strip_tags($request->card_name),
            'rarity' => strip_tags($request->rarity),
            'set_name'=> strip_tags($request->set_name),
            'description'=> strip_tags($request->description),
            'card_price'=>strip_tags($request->card_price),
            'card_img' => $imagePath,
        ]);

        //แสดง sweet alert
        Alert::success('Insert Successfully');
        return redirect('/card');

    } catch (\Exception $e) {  //error debug
        return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        //return view('errors.404');
    }
} //create 

public function edit($id)
    {
        try {
            $card = CardModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($card)) {
                $id = $card->id;
                $card_name = $card->card_name;
                $card_number = $card->card_number;
                $rarity = $card->rarity;
                $set_name = $card->set_name;
                $description = $card->description;
                $card_price = $card->card_price;
                $card_img = $card->card_img;
                return view('cards.edit', compact('id', 'card_name', 'card_number','rarity','set_name','description','card_price','card_img'));
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
        'card_name.required' => 'กรุณากรอกชื่อการ์ด',
        'card_name.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'card_number.required' => 'กรุณากรอก รหัสของการ์ด',
        'card_number.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'card_number.unique' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'rarity.required' => 'กรุณากรอก เบอร์ ',
        'rarity.min' => 'ต้องมีอย่างน้อย :min ตัวอักษร',
        'set_name.required' => 'กรุณากรอก ชุดของการ์ดนั้น ',
        'card_price.required' => 'กรุณากรอก ราคา ของการ์ดนั้น ',
        'card_img.mimes' => 'รองรับ jpeg, png, jpg เท่านั้น !!',
        'card_img.max' => 'ขนาดไฟล์ไม่เกิน 5MB !!',
    ];


    // ตรวจสอบข้อมูลจากฟอร์มด้วย Validator
    $validator = Validator::make($request->all(), [
        'card_number' => [
                        'required',
                        'min:3' ,
                            Rule::unique('tbl_card','card_number')->ignore($id,'id')],

        'card_name' => 'required|min:3',

        'card_img' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ], $messages);

    // ถ้า validation ไม่ผ่าน ให้กลับไปหน้าฟอร์มพร้อมแสดง error และข้อมูลเดิม
    if ($validator->fails()) {
        return redirect('card/' . $id)
            ->withErrors($validator)
            ->withInput();
    }

    try {
        // ดึงข้อมูลสินค้าตามไอดี ถ้าไม่เจอจะ throw Exception
        $card = CardModel::findOrFail($id);

        // ตรวจสอบว่ามีไฟล์รูปใหม่ถูกอัปโหลดมาหรือไม่
        if ($request->hasFile('card_img')) {
            // ถ้ามีรูปเดิมให้ลบไฟล์รูปเก่าออกจาก storage
            if ($card->card_img) {
                Storage::disk('public')->delete($card->card_img);
            }
            // บันทึกไฟล์รูปใหม่ลงโฟลเดอร์ 'uploads/student' ใน disk 'public'
            $imagePath = $request->file('card_img')->store('uploads/card', 'public');
            // อัปเดต path รูปภาพใหม่ใน model
            $card->card_img = $imagePath;
        }

        // อัปเดตชื่อสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $card->card_name = strip_tags($request->card_name);
        // อัปเดตรายละเอียดสินค้า โดยใช้ strip_tags ป้องกันการแทรกโค้ด HTML/JS
        $card->card_number = strip_tags($request->card_number);
        // อัปเดตราคาสินค้า


        // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
        $card->save();

        // แสดง SweetAlert แจ้งว่าบันทึกสำเร็จ
        Alert::success('Update Successfully');

        // เปลี่ยนเส้นทางกลับไปหน้ารายการสินค้า
        return redirect('/card');

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
        $card = CardModel::find($id); //คิวรี่เช็คว่ามีไอดีนี้อยู่ในตารางหรือไม่

        if (!$card) {   //ถ้าไม่มี
            Alert::error('card not found.');
            return redirect('card');
        }

        //ถ้ามีภาพ ลบภาพในโฟลเดอร์ 
        if ($card->card_img && Storage::disk('public')->exists($card->card_img)) {
            Storage::disk('public')->delete($card->card_img);
        }

        // ลบข้อมูลจาก DB
        $card->delete();

        Alert::success('Delete Successfully');
        return redirect('card');

    } catch (\Exception $e) {
        Alert::error('เกิดข้อผิดพลาด: ' . $e->getMessage());
        return redirect('card');
    }
} //remove 



} //class
