var globalProductId;
var Globalorder;
var total = 0;
var premium = 0;
var preferred = 0;
var economy = 0;
var basic = 0;

$(window).load(function () {
  FillSortableTable();
});

$(document).ready(function () {
 retrieveListProducts();
 populateCompanyList();
 
 $(':checkbox').click(function(event) {
        if( !$(this).prop("checked") ){
        $(this).prop("checked",true);
         
        } else {
            $(this).prop("checked",false);          

        } 
        
    });

    $(".products").click(function() {
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

    calculatePlans(); 
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
            retrieveListProducts();
            resetFields();
            $('#myModal').modal('hide');
        },
        failure: function (msg) {
        }
    });
});

$("body").on("click", "a", function (event) {
    globalProductId = $(this).attr('name');
});

$('#modifiedProduct').on('show.bs.modal', function() {
    resetFields();
    $.ajax({
        type: "GET",
        url: "infoProduct",
        data: {
        	ProductId: globalProductId
        },
        success: function (msg) {
            var data = JSON.parse(msg);
            $('#productNameModified').val(data[0].ProductName);
            $('#displayNameModified').val(data[0].DisplayName);
            $('#disclaimerModified').val(data[0].Disclaimer);
            $('#costModified').val(data[0].Cost);
            $('#sellingPriceModified').val(data[0].SellingPrice);
            
                if (data[1].Bullets != '') {
                    $('#bulletPoint1Modified').val(data[1].Bullets);
                }
                
                if (data[2].Bullets != '') {
                    $('#bulletPoint2Modified').val(data[2].Bullets);
                }
                
                if (data[3].Bullets != '') {
                    $('#bulletPoint3Modified').val(data[3].Bullets);
                }
                
                if (data[4].Bullets != '') {
                    $('#bulletPoint4Modified').val(data[4].Bullets);
                } 
                
                if (data[5].Bullets != '') {
                    $('#bulletPoint5Modified').val(data[5].Bullets);
                }
    
        },
        failure: function (msg) {
        }
    });
})

function resetFields() {
  $('#productNameModified').val('');
  $('#displayNameModified').val('');
  $('#disclaimerModified').val('');
  $('#costModified').val('');
  $('#sellingPriceModified').val('');
  $('#bulletPoint1Modified').val('');
  $('#bulletPoint2Modified').val('');
  $('#bulletPoint3Modified').val('');
  $('#bulletPoint4Modified').val('');
  $('#bulletPoint5Modified').val('');
}

function retrieveListProducts() {
    $.ajax({
        delay: 0,
        type: "GET",
        url: "getTable",
        success: onProductsLoad,
        failure: function (msg) {
            alert('Table could not be loaded');
        }
    });
}

function onProductsLoad(result)
{
    $('#productsTable').html(result);   

    $('#productsTable').delegate(':checkbox', 'click', function() {
         var id = $(this).attr('id');
         if( !$(this).prop("checked") ){
           deleteProduct(id);
         
         } else {
            insertProduct(id);
         }          
        setTimeout(function(){
            retrieveListProducts();
            FillSortableTable();
        },1000);
    });

    $('#productsTable').delegate(':button', 'click', function() {
         var id = $(this).attr('value');
         removeProduct(id);

         setTimeout(function(){
            retrieveListProducts();
            FillSortableTable();
        },1000);
    });
}

function removeProduct (idProduct) {
    $.ajax({
        type: "GET",
        url: "removeProduct",
        data: {
            ProductId: idProduct
        },        
        success: function (msg) {            
        },
        failure: function (msg) {
            alert('Product could not be removed');
        }
    });
}

function deleteProduct (idProduct) {
    $.ajax({
        type: "GET",
        url: "deleteProduct",
        data: {
            id: idProduct
        },        
        success: function (msg) {            
            
        },
        failure: function (msg) {
            alert('Table could not be loaded');
        }
    });
}

function insertProduct (idProduct) {
     $.ajax({
        type: "GET",
        url: "insertProduct",
        data: {
            id: idProduct
        },        
        success: function (msg) {            
            
        },
        failure: function (msg) {
            alert('Table could not be loaded');
        }
    });
}

function FillSortableTable () {
    $.ajax({
        delay: 0,
        type: "GET",
        url: "getSortableTable",
        success: function (msg) {
              $('#SortableTable').html
            (
                msg
            );
            Sortable();
        },
        failure: function (msg) {
            alert('Table could not be loaded');
        }
    });
}

function Sortable () {
    $(function() {
    $(".sortable").sortable({
        placeholder: "highlight",
        helper: "clone",
         stop: function(event, ui) {
         //console.log($(this).find('li').index(ui.item));
         Globalorder = $(".sortable").sortable('toArray');
         //console.log(ui.item.attr('id'));
         console.log(Globalorder);
         UpdatetOrderTable(Globalorder);
            
        }
    });
    $(".sortable").disableSelection();
  });
}

function UpdatetOrderTable (Order) {
    for (var i=0; i<Order.length; i++) {
             OrderProduct = i+1;
             $.ajax({
                    delay: 0,
                    type: "GET",
                    url: "updateOrderProducts",
                    data: {
                        Order: OrderProduct,
                        ProductId : Order[i],
                        PlansId : 1
                    },
                    success: function (msg) {                                              
                    },
                    failure: function (msg) {
                        alert('A error has ocurred');
                    }
                });
    }
    retrieveListProducts();
    FillSortableTable();
       
}

$('#updateInfo').click(function() {
    $.ajax({
        type: "GET",
        url: "updateProduct",
        data: {
            ProductId: globalProductId,
            ProductName: $('#productNameModified').val(),
            CompanyId: $('#CompanyIdModified').val(),
            displayName: $('#displayNameModified').val(),
            bulletPoint1: $('#bulletPoint1Modified').val(),
            bulletPoint2: $('#bulletPoint2Modified').val(),
            bulletPoint3: $('#bulletPoint3Modified').val(),
            bulletPoint4: $('#bulletPoint4Modified').val(),
            bulletPoint5: $('#bulletPoint5Modified').val(),
            disclaimer: $('#disclaimerModified').val(),
            cost: $('#costModified').val(),
            sellingPrice: $('#sellingPriceModified').val()
        },
        success: function (msg) {
                alert('Product Modified Succesfull');
                retrieveListProducts();
                $('#modifiedProduct').modal('hide');
        } 
    }); 
});

function populateCompanyList(){
    $.ajax({
        delay: 0,
        type: "GET",
        url: "populateCompanyList",
        success: function (msg) {

            $('#CompanyList').html
            (
                msg
            );
        },
        failure: function (msg) {
            alert('Company List could not be loaded');
        }
    });    
}

$('#saveCompany').click(function(){
    $.ajax({
        type: "GET",
        url: "createCompany",
        data: {
            CompanyName: $('#CompanyName').val()
        },
        success: function (msg) {
            populateCompanyList();
            alert(msg);
            $('#myModal').modal('show');
            $('#CompanyName').val('');
            $('#companyModal').modal('hide');
        } 
    }); 
});

$('#cancelCompany').click(function(){
    $('#CompanyName').val('');
    $('#companyModal').modal('hide');
    $('#myModal').modal('show');
});

$(':checkbox').click(function(event) {
    checkName = $(this).attr('name');
    
        if( !$(this).prop("checked") ){
            switch(checkName){          
                case 'Premium': value = $(this).val();
                                premium = parseFloat(premium) - parseFloat(value);
                                premium = Math.abs(premium);

                                $('#totalPremium').text(premium.toFixed(2)); break;

                case 'Preferred': value = $(this).val();
                                preferred = parseFloat(preferred) - parseFloat(value);
                                preferred = Math.abs(preferred);

                                $('#totalPreferred').text(preferred.toFixed(2)); break;

                case 'Economy': value = $(this).val();
                                economy = parseFloat(economy) - parseFloat(value);
                                economy = Math.abs(economy);

                                $('#totalEconomy').text(economy.toFixed(2)); break;

                case 'Basic': value = $(this).val();
                                basic = parseFloat(basic) - parseFloat(value);
                                basic = Math.abs(basic);

                                $('#totalBasic').text(basic.toFixed(2)); break;

            }
        } else {

            switch(checkName){
                case 'Premium': value = $(this).val();
                                premium = parseFloat(premium) + parseFloat(value);

                                $('#totalPremium').text(premium.toFixed(2)); break;

                case 'Preferred': value = $(this).val();
                                preferred = parseFloat(preferred) + parseFloat(value);

                                $('#totalPreferred').text(preferred.toFixed(2)); break;

                case 'Economy': value = $(this).val();
                                economy = parseFloat(economy) + parseFloat(value);

                                $('#totalEconomy').text(economy.toFixed(2)); break;

                case 'Basic': value = $(this).val();
                                basic = parseFloat(basic) + parseFloat(value);

                                $('#totalBasic').text(basic.toFixed(2)); break;

            }
        }          
});

function calculatePlans(){
    var groupPremium = document.getElementsByName('Premium');

    var sumPremium = 0.00;
    for (var i=0; i<groupPremium.length; i++){
        if (groupPremium[i].checked == true){
            sumPremium = sumPremium + parseFloat(groupPremium[i].value); 
        }
    }
    
    premium = sumPremium;
    $('#totalPremium').text(premium);

    // Preferred
    var groupPreferred = document.getElementsByName('Preferred');

    var sumPreferred = 0.00;
    for (var i=0; i<groupPreferred.length; i++){
        if (groupPreferred[i].checked == true){
            sumPreferred = sumPreferred + parseFloat(groupPreferred[i].value); 
        }
    }
    
    preferred = sumPreferred;
    $('#totalPreferred').text(preferred);

    // Economy
    var groupEconomy = document.getElementsByName('Economy');

    var sumEconomy = 0.00;
    for (var i=0; i<groupEconomy.length; i++){
        if (groupEconomy[i].checked == true){
            sumEconomy = sumEconomy + parseFloat(groupEconomy[i].value); 
        }
    }
    
    economy = sumEconomy;
    $('#totalEconomy').text(economy);

    // Basic
    var groupBasic = document.getElementsByName('Basic');

    var sumBasic = 0.00;
    for (var i=0; i<groupBasic.length; i++){
        if (groupBasic[i].checked == true){
            sumBasic = sumBasic + parseFloat(groupBasic[i].value); 
        }
    }
    
    basic = sumBasic;
    $('#totalBasic').text(basic);
}