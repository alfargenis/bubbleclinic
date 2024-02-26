<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reactivos extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function queueNumber()
    {
        return $this->belongsTo(QueueNumber::class);
    }

    public function scopeSearching($query, $keyword)
    {
        $query->when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('marca', 'like', '%' . $keyword . '%')
                ->orWhere('precio', 'like', '%' . $keyword . '%')
                ->orWhere('precio', 'like', '%' . $keyword . '%')
                ->orWhere('id_prueba', 'like', '%' . $keyword . '%');
        });
    }
}
