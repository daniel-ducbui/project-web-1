<!--Check error-->
@if(count($errors) > 0)
    <div class="row-">
        <div class="col-">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true"></button>
                <strong>Whoop!</strong>
                There were some problems with your input. <br><br>
                <ul style="padding-left: 5px;margin-top: 5px;color: blue;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if(Session::has('message'))
    <div class="row-">
        <div class="col-">
            <div class="alert alert-warning" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true"></button>
                {{ Session::get('message') }} <br><br>
            </div>
        </div>
    </div>
@endif
