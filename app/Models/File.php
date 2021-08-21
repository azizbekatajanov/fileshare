<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class File
 * @package App\Models
 * @property string $path
 * @property string $uniqid
 * @property Carbon $deleted_at
 */
class File extends Model
{
    use HasFactory;
    protected $casts = [
        'deleted_at' => 'datetime'
    ];
    protected $fillable=[
        'path', 'uniqid', 'deleted_at'
    ];
}
