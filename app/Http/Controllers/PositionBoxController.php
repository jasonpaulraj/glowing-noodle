<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionBoxContentCreateRequest;
use App\Http\Requests\PositionBoxContentUpdateRequest;
use App\Http\Requests\PositionBoxCreateRequest;
use App\Http\Requests\PositionBoxUpdateRequest;
use App\Http\Resources\PositionBoxCollection;
use App\Http\Resources\PositionBoxResource;
use App\Models\PositionBox;
use App\Models\PositionBoxContent;
use App\Models\PositionBoxText;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PositionBoxController extends Controller
{
    public function index(PositionBox $positionBox)
    {

        $data = PositionBox::take(1)->first();
        // dd($data);
        return view('positionbox.index', compact('data', $data));
    }

    public function edit(PositionBox $positionBox)
    {
        return view('positionbox.edit', compact('positionBox'));
    }

    public function editContent(PositionBox $positionBox, PositionBoxContent $positionBoxContent)
    {
        $sentenceList = PositionBoxText::all();
        $positionBoxText = PositionBoxText::findorfail($positionBoxContent['position_box_text']['id']);
        return view('positionbox.edit-content', compact('positionBox', 'positionBoxContent', 'sentenceList', 'positionBoxText'));
    }

    public function store(PositionBoxCreateRequest $request)
    {
        $request->validated();
        $positionBox = new PositionBox();
        $positionBox->fill($request->validated());
        $positionBox->save();


        return redirect()->back()->with('success', 'New table successfully created.');
    }

    public function addNewContent(PositionBox $positionBox, Request $request)
    {
        $sentenceList = PositionBoxText::all();

        return view('positionbox.add-content', compact('positionBox', 'sentenceList'));
    }

    public function storeContent(PositionBox $positionBox, PositionBoxContentCreateRequest $request)
    {
        $request->validated();
        $request->position = json_encode($request->position);
        $positionBox->position_box_content()->create([
            "position" => $request->position,
            "position_box_text_id" => $request->position_box_text_id,
            "text_color" => $request->text_color,
            "css_styling_code" => isset($request->css_styling_code) ? $request->css_styling_code : ''
        ]);

        return redirect()->back()->with('success', 'New content successfully added.');
    }

    public function update(PositionBox $positionBox, PositionBoxUpdateRequest $request)
    {
        $positionBox->fill($request->validated());

        $positionBox->save();

        return redirect()->route('positionbox.index')
            ->with('success', 'Table updated successfully');
    }

    public function updateContent(PositionBox $positionBox, PositionBoxContent $positionBoxContent, PositionBoxContentUpdateRequest $request)
    {
        $positionBoxContent->fill($request->validated());
        if (isset($request->position)) {
            $positionBoxContent->position = json_encode($request->position);
        }
        $positionBoxContent->save();

        return redirect()->back()->with('success', 'Content successfully updated.');
    }

    public function destroy(PositionBox $positionBox)
    {
        $positionBox->delete();

        return redirect()->back()->with('success', 'Table successfully deleted.');
    }

    public function destroyContent(PositionBox $positionBox, PositionBoxContent $positionBoxContent)
    {
        $positionBoxContent->delete();

        return redirect()->back()->with('success', 'Sentence successfully deleted.');
    }
}
