$(function() {

    function makePdf(){
        var route = $('#routePdf').attr('href');
        window.open(route, '_blank');
        // window.location = route;
    }

    var t = $("#datatable").DataTable({
        fnDrawCallback: function( oSettings ) {
       // $('div#data-table-custom_filter input').addClass("form-control banglaType").avro( {'bangla':true});
        },
        "responsive":true,
        "deferRender": true,
        "ordering": false,
          dom:"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "paging": true,
        "autoWidth": true,
        "columnDefs": [{ 
            "searchable": false,
            "orderable": false,
            "targets": 0 ,
            
        }],
         
        buttons: [
            {
                extend: 'copyHtml5',
            },
            {   extend: 'csv',
            },
            {
                extend: 'excelHtml5',
            },
            // {
            //     extend: 'print',
            //     autoPrint: true,
            //     customize: function (win) {
            //         $(win.document.body).children("h1:first").remove();
            //         $(win.document.body)
            //             .css( 'font-size', '10pt' ).prepend(
            //                 '<img src="http://localhost:8000/adminAssets/images/logo-text.png" style="position:absolute; top:0; left:0;" />'
            //             );

            //         $(win.document.body)
            //             .css( 'font-size', '10pt' )
            //             .append(
            //                 '<br><h6 align="center">Powered By: Grocers</h6>'
            //             );

            //         $(win.document.body).find( 'table' )
            //             .addClass( 'compact' )
            //             .css( 'font-size', 'inherit' );
            //     },
            // },
            {
                text: 'PDF',
                action: function ( e, dt, node, config ) {
                    makePdf();
                }
            },
        ],
        drawCallback: function() {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip({
                 animated: 'fade',
                 html: true
             });
         },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],	
    } );
    
    t.on( 'order.dt search.dt', function () { 
        t.column(0).nodes().each( function (cell, i) { 
            cell.innerHTML = i+1; } ); 
    } ).draw();

 

        
    var datatableProduct = $("#datatableProduct").DataTable({
        "responsive":true,
        "deferRender": false,
        "ordering": true,
        "dom":"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "paging": true,
        "autoWidth": true,
        "columnDefs": [{ 
            "searchable": false,
            "orderable": false,
            "targets": 0 ,
            'checkboxes': {
                'selectRow': true
             }
        }],
        
        'select': {
            'style': 'multi'
        },
        buttons: [
            {
                extend: 'copyHtml5',
            },
            {   extend: 'csv',
            },
            {
                extend: 'excelHtml5',
            },
            {
                text: 'PDF',
                action: function ( e, dt, node, config ) {
                    makePdf();
                }
            },
        ],
        drawCallback: function() {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip({
                animated: 'fade',
                html: true
            });
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],	
    } );

    // Handle form submission event
    $('#productDelete').on('click', function(){
        
        var rows_selected = datatableProduct.column(0).checkboxes.selected();
        var productIds = new Array();
       
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, productId){
            productIds.push(productId);
        });

        "use strict";
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        if(productIds.length > 0) {

            swal({
                title: "Are you sure to bulk delete?",
                text: "",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "No",
                confirmButtonColor: "#1ed49c",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            },
            function(isConfirm){
                if (isConfirm) {
                    
                    swal({
                        html:true,
                        title: '<svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /></svg>',
                        showConfirmButton: false,
                        showCancelButton: false,
                    });

                    $.ajax({
                        type: "POST",
                        url: $("#productDeleteRoute").attr('href'),
                        data:{ product_ids: productIds },
                        success: function(data){ 
                            if (data.message) {
                                $('#datatableProduct tr').has('input[type="checkbox"]:checked').remove();
                                localStorage.setItem("message",data.message)
                                window.location.reload(); 
                            }
                            
                        },
                        error:function(exception){
    
                            swal({
                                title: exception.responseJSON.warning,
                                text: "",
                                type: "error",
                                showCancelButton: true,
                                cancelButtonText: "Ok",
                                showConfirmButton: false,
                                closeOnConfirm: true
                            });
                        }
                    });
            
                }
            });
                    
        } else {
            swal({
                title: "No product is selected!!",
                text: "",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancel",
                showConfirmButton: false,
            });
        }    
    });

  
        $('#categoryName').on('change', function(){
            var search = [];
    
            $.each($('#categoryName option:selected'), function(){
                    search.push($(this).val());
            });
    
            search = search.join('|');
            datatableProduct.column(4).search(search, true, false).draw();  
        });
    
        $('#stockStatus').on('change', function(){
            var search = [];
    
            $.each($('#stockStatus option:selected'), function(){
                search.push($(this).val());
            });
    
            search = search.join('|');
            datatableProduct.column(8).search(search, true, false).draw();
        });

        //get it if Status key found
        if(localStorage.getItem("message"))
        {
            swal({
                title: localStorage.getItem("message"),
                text: "",
                type: "success",
                showCancelButton: false,
                confirmButtonColor: "#1ed49c",
                confirmButtonText: "Ok",
                closeOnConfirm: false,
            });
            localStorage.clear();
        }


});
