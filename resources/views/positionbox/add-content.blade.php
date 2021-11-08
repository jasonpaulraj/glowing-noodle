@extends('positionbox.layout')

@section('content')
@if (\Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
</div>
@endif
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Table Content</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('positionbox.index') }}"> Home</a>
            <a class="btn btn-primary" href="{{ route('positionbox.manage', ['position_box' => $positionBox['id']]) }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <h1> Table Details </h1>
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ route('positionbox.store.content', ['position_box' => $positionBox['id']]) }}">
        @csrf
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" id="position" name="position" class="form-control" required="" value="">
        </div>
        <div class="form-group">
            <label for="position_box_text_id">Sentence</label>
            <select class="form-control" required="" name="position_box_text_id" id="country">
                <option value="">Please select a sentence from the list.</option>
                @foreach($sentenceList as $sentence)
                <option value="{{$sentence['id']}}">{{$sentence['sentence']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="text_color">Text Colour</label>
            <input type="text" id="text_color" name="text_color" class="form-control" required="" value="">
        </div>
        <div class="form-group">
            <label for="css_styling_code">CSS Styling Metadata</label>
            <input type="textarea" id="css_styling_code" name="css_styling_code" class="form-control" required="" value="">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<br /><br /><br /><br />
@endsection