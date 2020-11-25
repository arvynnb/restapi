// $(document).ready(function($){
//     var table = $("#carsList").DataTable({       
//             ajax: {
//                 url: "/home/data",
//                 type: "GET",
//             },
//             columns: [
//                 {data: 'id'},
//                 {data: 'name'},
//                 {data: 'brand'},
//                 {data: 'color'},
//                 {
//                         data: "id",
//                         render: function (data, type, full) {
//                             let editBtn =  `
//                                 <div class='btn-group'>
//                                     <span data-placement='top' data-toggle='tooltip' title='Edit Job Designation'>
//                                         <button type='button' class='btn btn-sm btn-table btn-primary' 
//                                         data-car='{
//                                             "id":"${full.id}",
//                                         }'
//                                         data-id=${data} data-toggle='modal' id='edit_car_modal_button' data-target='#edit_car_modal'>
//                                         <i class="fa fa-edit"></i>
//                                         </button>
//                                     </span>
//                                 </div>
//                             `;

//                             return editBtn
//                         }
//                     }
//                 ],
//             });
  
// });