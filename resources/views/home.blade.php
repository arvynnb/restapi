@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="display:flex; justify-content:space-between;">
                    Dashboard
                        <button class="btn btn-success" data-toggle='modal'
                        id='add_car_modal_button' 
                        data-target='#add_car_modal'>Add</button>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="body" id="">
                        <div class="table-responsive">
                            <table id="carsList" class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Color</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_car_modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <form method="POST" id="add_car_details" action="/home/addcar" >
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Car</h4>
                </div>
                <br>
                <div class="modal-body" id="add_car_container">
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="car_name" id="car_name" class="form-control" placeholder="Car Name" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="car_brand" id="car_brand" class="form-control" placeholder="Car Brand" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="car_color" id="car_color" class="form-control" placeholder="Car Color" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_car_button" class="btn btn-primary waves-effect" 
                        data-toggle="modal" >Save</button>
                    <button type="button" class="btn btn-danger waves-effect closeModal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="edit_car_modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <form method="POST" id="edit_car_details" action="" >
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit Cars</h4>
                </div>
                <br>
                <div class="modal-body" id="edit_car_container">
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="hidden" name="car_id" id="car_id" value="">
                                    <input type="text" name="car_name_edit" id="car_name_edit" class="form-control" placeholder="Car Name" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="car_brand_edit" id="car_brand_edit" class="form-control" placeholder="Car Brand" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="car_color_edit" id="car_color_edit" class="form-control" placeholder="Car Color" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit_car_button" class="btn btn-primary waves-effect" 
                        data-toggle="modal" >Save</button>
                    <button type="button" class="btn btn-danger waves-effect closeModal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delete_car_modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <form method="POST" id="delete_car_details" action="" >
            <div class="modal-content">
                <div class="modal-body" id="delete_car_container">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Delete Car</h4>
                    </div>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="car_id_delete" id="car_id_delete">
                    <div class="modal-footer">
                        <button type="button" id="delete_car_button" class="btn btn-primary waves-effect" 
                            data-toggle="modal" >Delete</button>
                        <button type="button" class="btn btn-danger waves-effect closeModal"  data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    function cars() {
        var table = $("#carsList").DataTable({  
            order:[],
            ajax: {
                url: "/home/data",
                type: "GET",
            },
            columns: [
                // {data: 'id'},
                {data: 'name'},
                {data: 'brand'},
                {data: 'color'},
                {
                        data: "id",
                        render: function (data, type, full) {
                            let editBtn =  `
                                <div class='btn-group' >
                                    <span data-placement='top' data-toggle='tooltip' title='Edit Car'>
                                        <button type='button' class='btn btn-sm btn-table btn-primary' 
                                        data-name=${full.name} data-brand=${full.brand} data-color=${full.color}
                                        data-car='{
                                            "name":"${full.name}",
                                            "brand":"${full.brand}",
                                            "color":"${full.color}",
                                        }'
                                        data-id=${data} data-toggle='modal' id='edit_car_modal_button' data-target='#edit_car_modal'>
                                        <i class="fa fa-edit"></i>
                                        </button>
                                    </span>
                                </div>
                            `;

                            let deleteBtn =  `
                                <div class='btn-group'>
                                    <span data-placement='top' data-toggle='tooltip' title='Delete Car'>
                                        <button type='button' class='btn btn-sm btn-table btn-danger'
                                        data-id=${data} data-toggle='modal' id='delete_car_modal_button' data-target='#delete_car_modal'>
                                        <i class="fa fa-trash"></i>
                                        </button>
                                    </span>
                                </div>
                            `;

                            return editBtn + deleteBtn
                        }
                    }
                ],
            }); 
    }
    
    cars();

    $('#add_car_button').on('click', function () {
        $('#add_car_container').waitMe({
            effect: 'bounce',
            text: 'Please wait...',
            bg: 'rgba(255, 255, 255, 0.7)',
            color: '#000',
            maxSize: '',
            waitTime: -1,
            textPos: 'vertical',
            fontSize: '',
            source: '',
            onClose: function () {}
        });

        let name = $('#car_name').val();
        let brand = $('#car_brand').val();
        let color = $('#car_color').val();
        $.ajax({
            type: 'POST',
            url: '/home/addcar',
            data: {
                name: name,
                brand: brand,
                color: color,
                _token: $('#token').val()
            },
            success: function (response) {
                swal(response.message, '', response.status);
                var table = $('#carsList').DataTable();
                            $('#add_car_modal .closeModal').click();
                            $('#car_name').val("");
                            $('#car_brand').val("");
                            $('#car_color').val("");

                table.destroy();
                cars();
                
            },
            error: function (errorResponse) {
                $.each(errorResponse.responseJSON.errors, function (index, element) {
                    swal((JSON.stringify(element).replace("[\"", "")).replace("\"]", ""), '', 'error');
                });
            },
            complete: function (res) {
                $('.modal-backdrop').remove();
                $('#add_car_container').waitMe('hide');
            }
            
        })
    });

    $('#edit_car_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var car = button.data('car');
            // console.log($.parseJSON(car));
            // console.log(button.data('car').name);
            var id = button.data('id');
            var name = button.data('name');
            var brand = button.data('brand');
            var color = button.data('color');
            $('#car_id').val(id);
            $('#car_name_edit').val(name);
            $('#car_brand_edit').val(brand);
            $('#car_color_edit').val(color);
    });

    $('#edit_car_button').on('click', function () {
        $('#edit_car_container').waitMe({
            effect: 'bounce',
            text: 'Please wait...',
            bg: 'rgba(255, 255, 255, 0.7)',
            color: '#000',
            maxSize: '',
            waitTime: -1,
            textPos: 'vertical',
            fontSize: '',
            source: '',
            onClose: function () {}
        });
        $.ajax({
            type: 'POST',
            url: '/home/update',
            processData:false,
            contentType: false,
            data: new FormData(document.getElementById('edit_car_details')),
            success: function (response) {
                swal(response.message, '', response.status);
                
                var table = $('#carsList').DataTable();
                            $('#edit_car_modal .closeModal').click();
                            $('#car_name').val("");
                            $('#car_brand').val("");
                            $('#car_color').val("");

                table.destroy();
                cars();
            },
            error: function (errorResponse) {
                $.each(errorResponse.responseJSON.errors, function (index, element) {
                    swal((JSON.stringify(element).replace("[\"", "")).replace("\"]", ""), '', 'error');
                });
            },
            complete: function (res) {
                $('#edit_car_container').waitMe('hide');
                $('.modal-backdrop').remove();
            }
        })
    });


    $('#delete_car_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            $('#car_id_delete').val(id);
    });

    $('#delete_car_button').on('click', function () {
        $('#delete_car_container').waitMe({
            effect: 'bounce',
            text: 'Please wait...',
            bg: 'rgba(255, 255, 255, 0.7)',
            color: '#000',
            maxSize: '',
            waitTime: -1,
            textPos: 'vertical',
            fontSize: '',
            source: '',
            onClose: function () {}
        });
        $.ajax({
            type: 'POST',
            url: '/home/delete',
            processData:false,
            contentType:false,
            data: new FormData(document.getElementById('delete_car_details')),
            success: function (response) {
                swal(response.message, '', response.status);
                var table = $('#carsList').DataTable();
                $('#delete_car_modal .closeModal').click();

                table.destroy();
                cars();
            },
            error: function (errorResponse) {
                $.each(errorResponse.responseJSON.errors, function (index, element) {
                    swal((JSON.stringify(element).replace("[\"", "")).replace("\"]", ""), '', 'error');
                });
            },
            complete: function (res) {
                $('.modal-backdrop').remove();
            }
        })
    });
});
</script>
    
@endsection
