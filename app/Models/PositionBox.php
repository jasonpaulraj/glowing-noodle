<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PositionBox extends Model
{
    use UsesUuid, HasFactory;

    protected $fillable = [
        'box_rows', 'box_columns', 'box_disable_rows', 'box_disable_columns', 'visibility'
    ];

    protected $table = "position_box";

    protected $casts = [
        'id' => 'string',
    ];

    protected $with = [
        'position_box_content'
    ];

    protected static function boot()
    {
        parent::boot();
        PositionBox::saving(function ($model) {
            if (Auth::user()) {
                $model->updated_by = Auth::user()->id;
                $model->created_by = Auth::user()->id;
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Model Relationships
    |--------------------------------------------------------------------------
     */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function position_box_content()
    {
        return $this->hasMany(PositionBoxContent::class);
    }
}
