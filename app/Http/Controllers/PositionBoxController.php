<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionBoxCreateRequest;
use App\Http\Resources\PositionBoxCollection;
use App\Http\Resources\PositionBoxResource;
use App\Models\PositionBox;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PositionBoxController extends Controller
{
    public function index(PositionBox $positionBox)
    {
        return new PositionBoxResource($positionBox);
        return view('postionbox.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(PositionBox $positionBox)
    {
        return view('postionbox.edit', compact('post'));
    }

    public function update(PositionBox $positionBox, Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['sometimes', 'string', Rule::unique('vehicles')->ignore($positionBox->id)],
            'plate_number' => ['sometimes', 'string', Rule::unique('vehicles')->ignore($positionBox->id)],
        ]);
        $positionBox->name = $request->name;
        $positionBox->plate_number = $request->plate_number;

        $positionBox->save();

        return new PositionBoxResource($positionBox->fresh());
        return redirect()->route('postionbox.index')
            ->with('success', 'Post updated successfully');
    }
}
