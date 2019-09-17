@extends('layouts.app')
@section('content')
  <div class="container">
    
	  <!-- Current Books -->
        <div class="col-sm-offset-2 col-sm-8">
		<div class="panel panel-default">

		    <div class="panel-heading clearfix">
		        <span class="pull-left">積友一覧</span>

		    </div> 

		    <div class="panel-body table-responsive">
			<table class="table table-hover friend-table">
			    <thead>
    			    <th>ユーザー名</th>

			    </thead>
	　@if (count($friends) > 0)
			    <tbody>
				@foreach($friends as $friend)
				    <tr>
					    <td><a href='{{route('book.all', ['name' => $friend->name])}}'>{{ $friend->name }}</a>
					    </td>
		            <td>

    					    <form class="form-inline" action="{{ url('friend/'.$friend->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
		                        <div class="pull-right">    
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> フォロー解除
                                </button>
                                </div>
                            </form>

					</td>
					
				    </tr>
				@endforeach
			    </tbody>
	   @else
	            <tbody>

				    <tr>
					    <td>フォローしている積友はいません</td>
				    </tr>

			    </tbody>
	  　@endif	   
	   
	   
	   
			</table>

		</div>
		

	    
    </div>
    </div>
  </div>
  
@endsection