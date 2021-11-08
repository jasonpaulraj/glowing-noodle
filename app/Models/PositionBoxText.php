<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionBoxText extends Model
{
    use UsesUuid, HasFactory;

    protected $fillable = [
        'sentence'
    ];

    protected $table = "position_box_texts";

    protected $casts = [
        'id' => 'string',
    ];

    public function position_box_contents()
    {
        return $this->hasMany(PositionBoxContent::class);
    }
}
