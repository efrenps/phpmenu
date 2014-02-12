$(document).ready(function () {
    
    var ds = new kendo.data.DataSource('productList');

    var remoteDataSource = new kendo.data.DataSource(
    {
        transport:
        {
            read: {
                type: "GET",
                dataType: "json",
                url: "productList"
            }
        },
      });

  $("#grid").kendoGrid(
        {
            dataSource: remoteDataSource,
            columns: [
                {
                    title: "Company",
                    field: "Company",
                    headerAttributes: {
                        style: "text-align:center"
                    },
                    attributes: {
                        "class": "table-cell"
                    },
                    width: 200,
                    filterable: false
                },
                {
                    title: "Product Name",
                    
                    template: function (dataItem) {
                    if (typeof dataItem.ProductName != "undefined") {
                       return "<a href=\"" + dataItem.ProductId + "\" data-toggle='modal' data-target='#modifiedProduct' class='modify'>" + dataItem.ProductName + "</a>";
                     }
                   }, 

                    headerAttributes: {
                    },
                    attributes: {
                        "class": "table-cell",
                        style: "text-align:center"
                    },
                    width: 250,
                    filterable: true
                },
                {
                    title: "Bullets Points",
                    field: "Bullets",
                    filterable: true,
                    headerAttributes: {
                        style: "text-align:center"
                    },
                    attributes: {
                        "class": "table-cell",
                        style: "text-align:center"
                    }
                },
                {
                title: "Cost",
                field: "Cost",
                format: "{0}",
                headerAttributes: {
                    style: "text-align:center"
                },
                attributes: {
                    "class": "table-cell",
                    style: "text-align:center"
                },
                width: 100
               },
               {
                title: "Selling Price",
                field: "SellingPrice",
                format: "{0}",
                headerAttributes: {
                    style: "text-align:center"
                },
                attributes: {
                    "class": "table-cell",
                    style: "text-align:center"
                },
                width: 100
               }
        ],
        height: 430,
        scrollable: true,
        sortable: true,
        pageable: true,
        filterable: {
            extra: false,
            operators: {
                string: {
                    contains: "Contains",
                    startswith: "Starts with",
                    eq: "Is equal to",
                    neq: "Is not equal to"
                },
                number: {
                    eq: "Is equal to",
                    neq: "Is not equal to",
                    gte: "Greater Than",
                    lte: "Less Than"
                }
            }
        }
    });


    //88888888888888888888888888888888888888888888888888888888

    $(':checkbox').click(function(event) {
        if( !$(this).prop("checked") ){
        $(this).prop("checked",true);
         
        } else {
            $(this).prop("checked",false);          

        } 
        
    });

    $(".products").click(function() {
       //$("input:checkbox:not(:checked)")
       //$(this).find('input').attr('checked', false);
       //$(this).find('input:checkbox:not(:checked)').attr('checked', true);
        // Animation complete
        
       var checkbox = $(this).find("input[type='checkbox']");

        if( !checkbox.prop("checked") ){
            checkbox.prop("checked",true);
             $(this).css( "opacity", "1" );
        } else {
            checkbox.prop("checked",false);
            $(this).css( "opacity", "0.7" );
            $('.footerTable').css( "opacity", "1" );        

        } 
           
    });



    //888888888888888888888888888888888888888888888888888888888888888888888

});

$('#saveProduct').click(function() {
   $.ajax({
        type: "GET",
        url: "addProduct",
        data: {
        	ProductName: $('#productName').val(),
            CompanyId: $('#CompanyId').val(),
            displayName: $('#displayName').val(),
            bulletPoint1: $('#bulletPoint1').val(),
            bulletPoint2: $('#bulletPoint2').val(),
            bulletPoint3: $('#bulletPoint3').val(),
            bulletPoint4: $('#bulletPoint4').val(),
            bulletPoint5: $('#bulletPoint5').val(),
            disclaimer: $('#disclaimer').val(),
            cost: $('#cost').val(),
            sellingPrice: $('#sellingPrice').val()
        },
        success: function (msg) {
            alert(msg);
        },
        failure: function (msg) {
        }
    });
});

$('#modifiedProduct').on('show.bs.modal', function() {
	var id = $('.modify').attr('href');
    $.ajax({
        type: "GET",
        url: "infoProduct",
        data: {
        	ProductId: id
        },
        success: function (msg) {
        	var data = JSON.parse(msg);
            $('#productNameModified').val(data[0].ProductName);
            $('#displayNameModified').val(data[0].DisplayName);
        },
        failure: function (msg) {
        }
    });
})

/*$('#modifiedProduct').click(function() {
    
    $.ajax({
        type: "GET",
        url: "addProduct",
        data: {
        	
        },
        success: function (msg) {
            /*ProductName: $('#productName').val(),
            CompanyId: $('#CompanyId').val(),
            displayName: $('#displayName').val(),
            bulletPoint1: $('#bulletPoint1').val(),
            bulletPoint2: $('#bulletPoint2').val(),
            bulletPoint3: $('#bulletPoint3').val(),
            bulletPoint4: $('#bulletPoint4').val(),
            bulletPoint5: $('#bulletPoint5').val(),
            disclaimer: $('#disclaimer').val(),
            cost: $('#cost').val(),
            sellingPrice: $('#sellingPrice').val() 
        },
        failure: function (msg) {
        }
    }); 
}); */