@extends('layouts.app')
@section('content')
  <div class="container">
      <h3>{{$name}}の積読歴<br/></h3>   
	  <!-- Current Books -->

		<div class="panel panel-default">

		    <div class="panel-heading clearfix">
		        <span class="pull-left">積読歴</span>
		        <span class="pull-right">合計 {{ $count }}冊</span>
		    </div> 
		    
		    <div class="panel-body table-responsive">
			<table class="table table-hover book-table">
			    <thead>
    			    <th>書名</th>
				    <th>著者</th>
				    <th>翻訳者</th>
				    <th>出版者</th>
				    <th>進捗状況</th>
			    </thead>

	　 @if (count($books) > 0)
			    <tbody>
				@foreach($books as $book)
				    <tr>
					    <td>{{ $book->title }}</td>
					    <td>{{ $book->author }}</td>
					    <td>{{ $book->translator}} </td>
					    <td>{{ $book->publisher }}</td>
                        <td>{{ $book->status=='waiting' ? '未読': '読了' }}</td>
                        
                @if($name==Auth::user()->name)        
					<td>

    					    <a href={{ route('book.edit',[$book->id]) }}>
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-edit"></i> 編集
                                </button>
                            </a>
     
		            </td>
		            <td>

    					    <form class="form-inline" action="{{ url('book/all/'.$book->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
    
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> 削除
                                </button>
                            </form>

					</td>
				@endif	
					
				    </tr>
				@endforeach
			
			    </tbody>
	    @else
	            <tbody>

				    <tr>
					    <td>登録されている書籍はありません</td>
				    </tr>

			    </tbody>
	  　@endif	   
	   
	   
	   
			</table>



		</div>
		

	    
    </div>
    
    @if($name!=Auth::user()->name)

    
        <div class="pull-right">
                    
            <a class="btn btn-default" href={{url('friend/')}} role="button">積友一覧に戻る</a>
                    
        </div>
    @endif
  </div>
  
@endsection