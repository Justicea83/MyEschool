@if(Session::has('success'))
    <div class="row">
        <div class="col-xs-12 clear-padding-xs">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible text-center" role="alert">
                    <button type="button" @click="danger"  class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> {{Session::get('success')}}
                </div>
            </div>
        </div>
    </div>
@elseif(Session::has('error'))
    <div class="row">
        <div class="col-xs-12 clear-padding-xs">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                    <button type="button" @click="success" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> {{Session::get('error')}}
                </div>
            </div>
        </div>
    </div>
@endif