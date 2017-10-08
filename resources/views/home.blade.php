@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                     
                    
                      <h1 class="text-center">Your Api Key:</h1>
                      <h3 class="text-center">{{$user_api_key}}</h3>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
