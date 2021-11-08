@extends('positionbox.layout')

@section('content')

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <h1><a class="btn btn-primary" href="{{ URL::route('positionbox.manage', ['position_box' => $data['id']]) }}" class="ml-1 underline">Manage</a></h1>

    <br>
    <a class="btn btn-primary" href="{{ route('positionbox.content.add', ['position_box' => $data['id']]) }}">ADD CONTENT</a>
    <br><br><br><br>
    <table class="table table-bordered" width="50%" border="1" cellpadding="3" cellspacing="0">
        <tbody>
            <!-- Repeat rows -->
            @for($row=0;$row<$data['box_rows'];$row++) 
                @if(isset($data['position_box_content']) && !empty($data['position_box_content'])) 
                
                    @foreach($data['position_box_content'] as $content) 

                        @php($contentPosition=json_decode($content['position'])) 

                        @if(isset($contentPosition) && !empty($contentPosition)) 
                            @php($sentenceRow=explode(',',$contentPosition)[1])
                            @php($sentenceColumn=explode(',',$contentPosition)[0]) 
                        @endif

                   

                <tr>
                <!-- Repeat columns -->
                @for($column=0;$column<$data['box_columns'];$column++) <!-- If the looped row & looped column matches the stipulated position for the sentence content, display the sentence -->
                    @if(
                    isset($sentenceRow,$sentenceColumn) &&
                    ($row == $sentenceRow && $column == $sentenceColumn))

                        @if(isset($content['position_box_text']['sentence']))
                            @php($sentence = $content['position_box_text']['sentence'])
                        <td style="color:{{$content['text_color']}}" width="50" height="50"><p style="{{$content['css_styling_code']}}">{{$sentence}}</p></td>
                        @endif

                    @else
                    
                        <td width="50" height="50">&nbsp;</td>
                    
                    @endif

                @endfor
                @endforeach 

@endif 
                </tr>
                    
            @endfor
        <tbody>
    </table>
</div>

@endsection