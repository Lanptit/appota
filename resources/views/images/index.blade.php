@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding-bottom: 25px;">
                {!! Auth::user()->name !!}'s Image
                <!-- <button class="btn btn-info" style="margin-left:500px">Upload Image</button> -->
                <a href="{!! route('image.create') !!}" class="btn btn-info pull-right">Upload Image</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {!! session('status') !!}
                    </div>
                    @endif
                    @if(count($images))
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Image</th>
                                    <th>Image thumbnail</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $index => $image)
                                <tr>
                                    <td>{!! ($index + 1)+ 5*($images->currentPage()-1) !!}</td>
                                    <td><a href="{!! 'assets/image/'.substr($image->image, 0, 10).'/'.$image->image !!}" target="blank">{!! $image->image !!}</a></td>
                                    <td><img src="{!! 'assets/image/'.substr($image->image, 0, 10).'/'.$image->image !!}" style="width:100px; height: 100px"></td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['image.destroy', $image->id ]])!!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {!! $images->render() !!}
                    </div>
                    @else
                    You don't upload photos
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
