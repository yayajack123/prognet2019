@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>Reply Response</h5>
                </div>

                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="/admin/response">
                    @csrf
                    <input type="hidden" name="review_id" value="{{$review->id}}">
                        <div class="control-group">
                            <label class="control-label">User Comment :</label>
                            <div class="controls">
                                <div class="input-prepend">
                                <textarea id="name" class="form-control" readonly="" value="" style="width:500px;" autofocus="">{{$review->content}}</textarea>
                            </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Response :</label>
                            <div class="controls">
                                <textarea id="name" class="form-control" name="response" value="" style="width:500px;" autofocus=""></textarea>
                            </div>
                        </div>
                         <div class="control-group">
                            <label for="control-label"></label>
                            <div class="controls">
                                <input type="submit" name="submit" value="Send Review" class="btn btn-success">
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('js/jquery.toggle.buttons.js')}}"></script>
    <script src="{{asset('js/masked.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.form_common.js')}}"></script>
    <script src="{{asset('js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-wysihtml5.js')}}"></script>
@endsection