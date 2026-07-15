<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 👈 შემოვიტანეთ საჭირო თულბოქსი
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // 👈 ჩავსვით მოდელში, რომ ფაბრიკამ იმუშაოს

    // ველები შევუსაბამეთ მიგრაციას (image შევცვალეთ image_url-ით)
    protected $fillable = ['category_id', 'name', 'description', 'price', 'stock', 'image_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}