<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'link', 'type_id', 'slug'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getTypeBadge()
    {
        return $this->type ? "<span class='badge' style='background-color: {$this->type->color}'>{$this->type->name}</span>" : 'Untyped';
    }

    public function getTechnologyBadges()
    {
        $badges_html = '';
        foreach ($this->technologies as $technology) {
            $badges_html .= "<span class='badge rounded-pill mx-1' style='background-color: {$technology->color}'>{$technology->name}</span>";
        }
        return $badges_html;
    }
}
