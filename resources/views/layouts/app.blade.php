<!DOCTYPE html>
<html lang="ja">
      <head>
          
          
	      <title>積読管理アプリ</title>

          <meta charset='utf-8'>
        　<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    　　　<meta name='csrf-token' content='{{ csrf_token() }}'>

	      <!-- Fonts -->
            <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	      <!-- Styles -->

	      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

	      <script src='{{ asset("js/app.js") }}' defer></script>
      </head>

      <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   
      <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    　<div class="container" style="padding:0 0 60px 0">
　    
    　   <nav class="navbar navbar-inverse navbar-fixed-top">
    	    <div class="container-fluid">
    		<div class="navbar-header">
    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarBook" aria-expanded="false" aria-controls="navbar">
    				<span class="sr-only">Toggle navigation</span>
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    			</button>
    			<a class="navbar-brand" href="#">
    				積読管理アプリ
    			</a>
    		</div>
    		
    		<div class="collapse navbar-collapse" id="navbarBook">
        			<ul class="nav navbar-nav navbar-left">
     				    @guest
          				
        				@else
            				<li><a href="{{url('/')}}">積読一覧</a></li>
            				<li>
            				    <a href="{{ route('book.all', ['name' => Auth::user()->name])}}">            				
                 				        積読歴
                				</a>
                			</li>
            				<li><a href="{{url('/friend')}}">積友一覧</a></li>
            				<li><a href="{{url('/map')}}">書店探訪</a></li>
        				@endguest

                    </ul>
    			<ul class="nav navbar-nav navbar-right">
        		<!-- Right Side Of Navbar -->
                    <!-- Authentication Links -->

                    @guest
                        <li>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                    
                        <li class="hidden-xs">
                            <a href="#">
                                 user name | {{ Auth::user()->name }} 
                            </a>
                        </li>
                        <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                        </li>
                        
                    @endguest
                </ul>
            </div>
    	</div>
        </nav>
    </div>



	  @yield('content')

	  <!-- JavaScripts -->
   	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      
      </body>
</html>