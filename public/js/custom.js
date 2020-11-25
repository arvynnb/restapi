$(document).ready(function($){
    function cars() {
        var table = $("#carsList").DataTable({  
            order:[[0,"desc"]],
            serverSide: true,
            processing: true,
            ajax: {
                dataType: 'json',
                url: "/home/data",
                type: "GET",
            },
            columns: [
                {data: 'id'},
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
            columnDefs: [
                {   
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
            ]
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
            console.log(car);
            // console.log($.parseJSON(car));
            // console.log(button.data('car').name);
            var id = button.data('id');
            var name = button.data('name');
            var brand = button.data('brand');
            var color = button.data('color');
            console.log(color);
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
                $('#delete_car_container').waitMe('hide');
                $('.modal-backdrop').remove();
            }
        })
    });
});