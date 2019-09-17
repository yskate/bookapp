@extends('layouts.app')
@section('content')
  <div class="container">
    
<div class="col-sm-offset-2 col-sm-8">
	<div class="panel panel-default">
	    <div class="panel-heading">
		書籍データ編集
	    </div>

	    <div class="panel-body">
		<!-- Display Validation Errors -->
	    @include('common.errors')


		<!-- New Task Form -->
		<form action="{{ route('book.update', ['id' =>  $book->id])  }}" method="POST" class="form-horizontal">
		    {{ csrf_field() }}

		    <!-- Task Name  -->
		    <div class="form-group">
		        
    			<label for="book-title" class="col-sm-3 control-label">書名</label>
    			<div class="col-sm-9">
    			    <input type="text" name="title" id="book-title" class="form-control" value='{{ $book->title }}'>
    			</div>
            </div>
            
		    <div class="form-group">    			
    			<label for="author-name" class="col-sm-3 control-label">著者</label>
    			<div class="col-sm-9">
    			    <input type="text" name="author" id="author-name" class="form-control" value='{{ $book->author }}'>
    			</div>
            </div>
            
		    <div class="form-group">  
    		    <label for="translator-name" class="col-sm-3 control-label">翻訳者</label>
    			<div class="col-sm-9">
    			    <input type="text" name="translator" id="translator-name" class="form-control"  value='{{ $book->translator=='-' ? '' : $book->translator }}'placeholder="空欄可">
    			</div>
            </div>
            
		    <div class="form-group">      		    
    		    <label for="publisher-name" class="col-sm-3 control-label">出版社</label>
    			<div class="col-sm-9">
    			    <input type="text" name="publisher" id="publisher-name" class="form-control" value='{{ $book->publisher }}'>
    			</div>
    	    </div>
    	    
    	    <div class="form-group">
    	        <label for="status-name" class="col-sm-3 control-label">進捗状況</label>
    			<div class="col-sm-9">
                <div class="radio-inline">
                    <input type="radio" name="status" id="waiting" value="waiting">
                    <label for="waiting">未読</label>
                </div>
                 <div class="radio-inline">
                    <input type="radio" name="status" id="completed" value="completed">
                    <label for="completed">読了</label>
                </div>
                </div>
            </div>
    	    
    	    
    	    <div  class="row">
            <div class="col-md-10 text-right">

                <a class="btn btn-default" href={{url('book/all/'.\Auth::user()->name)}} role="button">一覧に戻る</a>

            </div>
    			
            <div class="col-md-2 pull-right">
    			{{ csrf_field() }}
    			<button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> 更新
                </button>
            </div>
            </div>


		</form>
	    </div>
	</div>
	    
    </div>
  </div>
@endsection