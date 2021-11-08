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
            <h2>Edit Table Size & Content</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('positionbox.index') }}"> Home</a>
            <a class="btn btn-primary" href="{{ route('positionbox.index') }}"> Back</a>
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
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{ route('positionbox.update', ['position_box' => $positionBox['id']]) }}">
        @csrf
        <div class="form-group">
            <label for="box_rows">No. of Rows</label>
            <input type="text" id="box_rows" name="box_rows" class="form-control" required="" value="{{$positionBox['box_rows']}}">
        </div>
        <div class="form-group">
            <label for="box_columns">No. of Columns</label>
            <input type="text" id="box_columns" name="box_columns" class="form-control" required="" value="{{$positionBox['box_columns']}}">
        </div>
        <div class="form-group">
            <br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
    <br>
    <a class="btn btn-primary" href="{{ route('positionbox.content.add', ['position_box' => $positionBox['id']]) }}">ADD CONTENT</a>
    <br>
</div>
<br /><br /><br /><br />
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <h1> Table Content Details </h1>
    @if(isset($positionBox['position_box_content']) && !empty($positionBox['position_box_content']))
    <table class="table table-bordered" width="50%" border="1" cellpadding="3" cellspacing="0">
        <tr>
            <th>Text Position (Row x Column)</th>
            <th>Sentence</th>
            <th>Font Color</th>
            <th>Styling Metadata</th>
            <th>Action</th>
        </tr>

        @foreach($positionBox['position_box_content'] as $content)

        @php($contentPosition = json_decode($content['position']))
        @php($contentSentence = $content['position_box_text']['sentence'])
        @php($sentenceRow = explode(',',$contentPosition)[0])
        @php($sentenceColumn = explode(',',$contentPosition)[1])
        <tr style="text-align:center;">
            <td>{{$sentenceRow}} x {{$sentenceColumn}}</td>
            <td>{{$contentSentence}}</td>
            <td>{{$content['text_color']}}</td>
            <td>{!!$content['css_styling_code']!!}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('positionbox.manage.content', ['position_box' => $positionBox['id'],'position_box_content' => $content['id']]) }}">EDIT</a>
                <a class="btn btn-warning" href="{{ route('positionbox.delete.content', ['position_box' => $positionBox['id'],'position_box_content' => $content['id']]) }}" onclick="return confirm('Are you sure?')">DELETE</a>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <br />
    <br />
    <h1>No Content Found.</h1>
    <br />
    <br />
    @endif
    <br /><br /><br /><br />
</div>
@endsection