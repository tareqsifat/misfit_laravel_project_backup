<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'project_code',
        'description',
        'status',
        'creator',
        'slug',
    ];

    public function setStatusAttribute($value): void
    {
        // Map string values to corresponding integers
        $statusMap = [
            'pending' => 1,
            'working' => 2,
            'done' => 3,
        ];

        // Set the attribute with the mapped value
        $this->attributes['status'] = $statusMap[$value] ?? $value;
    }

    // Accessor for 'status' attribute
    public function getStatusAttribute($value): string
    {
        // Map integer values to corresponding strings
        $statusMap = [
            1 => 'pending',
            2 => 'working',
            3 => 'done',
        ];

        // Get the string representation from the map or use the original value
        return $statusMap[$value] ?? $value;
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
