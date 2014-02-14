@extends('master')

@section('content')

<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">{{ HTML::image("images/logo.png", "Logo") }}</a>
    </div>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- <div id="grid"></div>  apply grid column  -->
<div class="container">
<div class="col-md-9">
<input type="button" class="btn btn-success" id="addProduct" value="Add Product" data-toggle="modal" data-target="#myModal">
<div id="productsTable"></div>
</div>
<!--/div -->
{{-- END OF GRID COLUMN 9 --}}

<div id="SortableTable" class="col-md-3 space">
    
</div>

</div>
{{-- end container --}}

<!-- Starts modal new product -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add/Edit Product</h4>
      </div>
      <div class="modal-body row-fluid">
           
            <div class="span6">
            <div class="form-group">
              <label for="CompanyId">Company Name</label>
              <div id="CompanyList"></div>
            </div>
            <div class="form-group">
              <label for="productName">Product Name</label>
              <input type="text" name="productName" id="productName" class="form-control" style="width:40%">
            </div>
            <div class="form-group">
              <label for="displayName">Display Name</label>
              <input id="displayName" type="text"class="form-control" class="form-control" style="width:40%">
            </div>
            <div class="form-group">
              <label for="bulletsPoints">Bullets Points</label>
              <div class="form-group">
                <input id="bulletPoint1" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <div class="form-group">
                <input id="bulletPoint2" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <div class="form-group">
                <input id="bulletPoint3" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <div class="form-group">
              <input id="bulletPoint4" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <input id="bulletPoint5" type="text"class="form-control" class="form-control" style="width:40%">
            </div>
            <div class="form-group">
              <label for="disclaimer">Disclaimer</label>
              <textarea id="disclaimer" class="form-control" name="disclaimer"></textarea>
            </div>
    </div>
    <div class="span6">
      <div class="form-group">
        <label for="cost">Cost</label>
        <input id="cost" type="text"class="form-control" class="form-control" style="width:40%">
      </div>
      <div class="form-group">
        <label for="sellingPrice">Selling Price</label>
        <input id="sellingPrice" type="text"class="form-control" class="form-control" style="width:40%">
      </div>
      <div class="form-group">
        <a class="btn btn-primary" data-dismiss="modal" data-toggle="modal" href="#companyModal">Add Company</a>
      </div>
    </div>

      </div>
       
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="saveProduct" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- End modal for manual entry --> 

<!-- Modal for new company -->
<div class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add New Company</h4>
      </div>
      <div class="modal-body row-fluid">
        <div class="span6">
          <div class="form-group">
            <label for="CompanyId">Company Name</label>
            <input type="text" name="CompanyName" id="CompanyName" class="form-control" style="width:40%" required>
          </div>
        </div>
      </div>
       
      <div class="modal-footer">
        <button type="button" id="cancelCompany" class="btn btn-default">Cancel</button>
        <button type="button" id="saveCompany" class="btn btn-primary">Save Company</button>
      </div>
    </div>
  </div>
</div>
<!-- ends modal for new company -->

<!-- Starts modal for update product -->
<div class="modal fade" id="modifiedProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modify Product</h4>
      </div>
      <div class="modal-body row-fluid">
           
            <div class="span6">
            <div class="form-group">
              <label for="CompanyIdModified">Company Name</label>
              <select name="CompanyIdModified" id="CompanyIdModified">
              @foreach ($Companies as $Company)
              	<option value="{{{ $Company->id }}}">{{{ $Company->CompanyName }}}</option>
              @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="productNameModified">Product Name</label>
              <input type="text" name="productNameModified" id="productNameModified" class="form-control" style="width:40%" required>
            </div>
            <div class="form-group">
              <label for="displayNameModified">Display Name</label>
              <input id="displayNameModified" name="displayNameModified" type="text"class="form-control" class="form-control" style="width:40%" required>
            </div>
            <div class="form-group">
              <label for="bulletsPoints">Bullets Points</label>
              <div class="form-group">
                <input id="bulletPoint1Modified" type="text"class="form-control" class="form-control" style="width:40%" required>
              </div>
              <div class="form-group">
                <input id="bulletPoint2Modified" type="text"class="form-control" class="form-control" style="width:40%" required>
              </div>
              <div class="form-group">
                <input id="bulletPoint3Modified" type="text"class="form-control" class="form-control" style="width:40%" required>
              </div>
              <div class="form-group">
              <input id="bulletPoint4Modified" type="text"class="form-control" class="form-control" style="width:40%" required>
              </div>
              <input id="bulletPoint5Modified" type="text"class="form-control" class="form-control" style="width:40%" required>
            </div>
            <div class="form-group">
              <label for="disclaimerModified">Disclaimer</label>
              <textarea id="disclaimerModified" class="form-control" name="disclaimerModified" required></textarea>
            </div>
    </div>
    <div class="span6">
      <div class="form-group">
        <label for="costModified">Cost</label>
        <input id="costModified" type="text" class="form-control" style="width:40%" required>
      </div>
      <div class="form-group">
        <label for="sellingPriceModified">Selling Price</label>
        <input id="sellingPriceModified" type="text" class="form-control" style="width:40%" required>
      </div>
    </div>

      </div>
       
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="updateInfo" class="btn btn-primary">Update Product</button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- End modal for manual entry --> 

@stop
