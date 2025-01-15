<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
        protected $fillable = [
            'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail'
        ];
    
    protected $guarded = array('id');
    public static $rules = array(
        'category_id' => 'required',
    );

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    // 名前やメールアドレスなどのkeywordで検索
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('first_name', 'like', '%' . $keyword . '%')
                ->orWhere('last_name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
    }

    // 性別で絞り込み検索
    public function scopeGenderSearch($query, $gender)
    {
        if ($gender !== null) {
        // 文字列ではなく、整数として比較
        $query->where('gender', (int)$gender);
        }
    }

    // お問い合わせの種類で絞り込み検索
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    // 登録年月日で絞り込み検索
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }

}
