@extends('layouts.app')
@section('content')
  <div class="container">

    @auth
    <div class="col-sm-offset-2 col-sm-8">
	<div class="panel panel-default">
	    <div class="panel-heading">
		新規
	    </div>

	    <div class="panel-body">
		<!-- Display Validation Errors -->
	    @include('common.errors')


		<!-- New Task Form -->
		<form action="{{ url('book')  }}" method="POST" class="form-horizontal">
		    {{ csrf_field() }}

		    <!-- Task Name  -->
		    <div class="form-group">
		        
    			<label for="book-title" class="col-sm-3 control-label">書名</label>
    			<div class="col-sm-9">
    			    <input type="text" name="title" id="book-title" class="form-control">
    			</div>
            </div>
            
		    <div class="form-group">    			
    			<label for="author-name" class="col-sm-3 control-label">著者</label>
    			<div class="col-sm-9">
    			    <input type="text" name="author" id="author-name" class="form-control">
    			</div>
            </div>
            
		    <div class="form-group">  
    		    <label for="translator-name" class="col-sm-3 control-label">翻訳者</label>
    			<div class="col-sm-9">
    			    <input type="text" name="translator" id="translator-name" class="form-control" placeholder="空欄可">
    			</div>
            </div>
            
		    <div class="form-group">      		    
    		    <label for="publisher-name" class="col-sm-3 control-label">出版社</label>
    			<div class="col-sm-9">
    			    <input type="text" name="publisher" id="publisher-name" class="form-control">
    			</div>
    	    </div>

		    <!-- Add Task Button -->
		    <div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
			    <button type="submit" class="btn btn-default">
				<i class="fa fa-btn fa-plus"></i> 補充
			    </button>
			</div>
		    </div>
		</form>
	    </div>
	</div>
    @endauth
	  <!-- Current Books -->
	　@if (count($books) > 0)
		<div class="panel panel-default">
		    <div class="panel-heading clearfix">
		        <div class="pull-left">積読一覧</div>
		        <div class="pull-right">合計 {{ $count }}冊</div>
		    </div>
		    
		    <div class="panel-body table-responsive">
			<table class="table table-hover book-table">
			    <thead>
    			    <th>書名</th>
				    <th>著者</th>
				    <th>翻訳者</th>
				    <th>出版者</th>
			    </thead>
			    <tbody>
				@foreach($books as $book)
				    <tr>
					    <td>{{ $book->title }}</td>
					    <td>{{ $book->author }}</td>
					    <td>{{ $book->translator}} </td>
					    <td>{{ $book->publisher }}</td>

					<!-- Book Delete Button -->
					<td>
                    @auth
					    <form action="{{ url('book/'.$book->id) }}" method="POST">
					        {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> 読了
                            </button>
                        </form>
					@endauth
					</td>
					
				    </tr>
				@endforeach
			    </tbody>
			</table>
		    </div>
		</div>
	  @endif
	    
    </div>
  </div>
@endsection