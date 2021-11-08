<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PositionBoxContent extends Model
{
    use UsesUuid, HasFactory;

    protected $fillable = [
        'position','css_styling_code','text_color','position_box_text_id'
    ];

    protected $with = [
        'position_box_text'
    ];

    protected $table = "position_box_contents";

    protected $casts = [
        'id' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();
        PositionBoxContent::saving(function ($model) {
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

    public function position_box_group()
    {
        return $this->belongsTo(PositionBox::class);
    }

    public function position_box_text()
    {
        return $this->belongsTo(PositionBoxText::class);
    }
}
