@extends('layouts.app')

@section('content')
<div class="container">
    @auth
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                
        
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

            </div>
            
        </div>
    
    </div>
    
    
    @else
                <div class="text-center">
                <h2>
                積読管理アプリへようこそ<br/><br/>     
                <br/>    
                このアプリは本を積むことを楽しむ<br/>
                読書人のためのアプリです<br/>
                <br/>
                『よく読み、よく積む』<br/>
                <br/>
                そんなあなたの読書ライフをサポートします
                </h2>
                </div>
                
    @endauth
                
</div>
@endsection
