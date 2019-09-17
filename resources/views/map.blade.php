
@extends('layouts.app')

@section('content')

<div class="container">
            
            
        <h3>さあ、最寄りの書店を探しましょう<br/></h3>
	    <form action="{{ url('map/')}}" method="GET">
		     {{ csrf_field() }}
		    <div class="form-group">
    			    <input name="place" type="text"/>
    			    <button type="submit" id="button" class="btn btn-default">
    			        検索
    			    </button>   
            </div>
        </form>
    <div class="embed-responsive embed-responsive-4by3">
        <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key=xxx&amp;q={{$place}}'
        width='100%'
        height='320'
        frameborder='0'>
        </iframe>
    </div>
</div>


@endsection

