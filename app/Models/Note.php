<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;


class Note extends Model
{
    protected $fillable = ['title', 'content', 'status', 'attachment', 'user_id', 'created_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getShortContentAttribute()
    {
        return Str::limit($this->content, 150);
    }
     
    public function getJalaliCreatedAtAttribute()
    {
        if (!$this->created_at) {
            return null;
        }
        
        $jalaliDate = Jalalian::fromDateTime($this->created_at)->format('Y/m/d');
        
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        
        return str_replace($english, $persian, $jalaliDate);
    }
    
    public function getAttachmentUrlAttribute()
    {
        return $this->attachment ? asset('storage/' . $this->attachment) : null;
    }
}