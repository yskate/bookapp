
@extends('layouts.app')

@section('content')

<div class="container">
            
            
        <h3>積友を探しましょう(作業中)<br/></h3>
	    <form action="{{ url('search/')}}" method="GET">
		     {{ csrf_field() }}
		    <div class="form-group">
    			    <input name="word" type="text"/ placeholder="好きな著者名">
    			    <button type="submit" id="button" class="btn btn-default">
    			        検索
    			    </button>   
            </div>
            
            
        </form>

	@if (count($friends) > 0)        
        <div class="col-sm-8">
            <div class="panel panel-default">
    
    		    <div class="panel-heading clearfix">
    		        <span class="pull-left">検索ワード「{{$word}}」</span>
    		    </div> 
    		    
    		    <div class="panel-body table-responsive">
    			<table class="table table-hover search-table">
    			    <thead>
        			    <th>ユーザー名</th>
    			    </thead>
    			    <tbody>
    				@foreach($friends as $friend)
    				    <tr>
    					    <td><a href='{{route('book.all', ['name' => $friend->name])}}'>{{ $friend->name }}</a></td>
    				@if(0)
    					<td>
      
                            <form action="{{ url('search/'.$friend->name) }}" method="POST">
    					        {{ csrf_field() }}
    					        <div class="pull-right">    
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check"></i> フォローする
                                </button>
                                </div>
                            </form>
    		            </td>
                    @endif
    				    </tr>
    				@endforeach
    			    </tbody>
    			</table>
    		</div>
        </div>			


	@else

		<div>検索結果はありません</div>

	@endif	   



</div>


@endsection

