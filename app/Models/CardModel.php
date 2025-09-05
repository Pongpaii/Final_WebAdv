<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardModel extends Model
{
    protected $table = 'tbl_card';
    protected $primaryKey = 'id'; // ตั้งให้ตรงกับชื่อจริงใน DB
    protected $fillable = ['card_name', 'card_number', 'rarity', 'set_name','description','card_price', 'card_img'];
    public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
    public $timestamps = false; // ใส่บรรทัดนี้ถ้าไม่มี created_at, updated_at
}



