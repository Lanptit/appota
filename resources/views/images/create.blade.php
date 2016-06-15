@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Image</div>

                <div class="panel-body">
                    @if(count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input. <br><br>
							<ul>
								@foreach($errors->all() as $error)
									<li>{!! $error !!}</li>
								@endforeach
							</ul>
						</div>
                    @endif

                    {!! Form::open([
										'route' 	=> ['image.store'],
										'method'	=> 'POST',
										'files'		=> true  	
                    ]) !!}
                    <div class="form-group" style="width: 300px;">
						{!! Form::label('image', 'Choose an image', ['class' => 'control-label']) !!}
						{!! Form::file('images[]', ['id' => 'image', 'multiple' => 'multiple', 'class' => 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}
					</div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop