@extends('master')

@section('content')

<input type="button" id="addProduct" value="Add Product" data-toggle="modal" data-target="#myModal">

<div id="grid"></div>

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
              <select name="CompanyId" id="CompanyId">
              @foreach ($Companies as $Company)
              	<option value="{{{ $Company->id }}}">{{{ $Company->CompanyName }}}</option>
              @endforeach
              </select>
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
              <label for="CompanyId">Company Name</label>
              <select name="CompanyId" id="CompanyId">
              @foreach ($Companies as $Company)
              	<option value="{{{ $Company->id }}}">{{{ $Company->CompanyName }}}</option>
              @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="productNameModified">Product Name</label>
              <input type="text" name="productNameModified" id="productNameModified" class="form-control" style="width:40%">
            </div>
            <div class="form-group">
              <label for="displayNameModified">Display Name</label>
              <input id="displayNameModified" name="displayNameModified" type="text"class="form-control" class="form-control" style="width:40%">
            </div>
            <div class="form-group">
              <label for="bulletsPoints">Bullets Points</label>
              <div class="form-group">
                <input id="bulletPoint1Modified" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <div class="form-group">
                <input id="bulletPoint2Modified" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <div class="form-group">
                <input id="bulletPoint3Modified" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <div class="form-group">
              <input id="bulletPoint4Modified" type="text"class="form-control" class="form-control" style="width:40%">
              </div>
              <input id="bulletPoint5Modified" type="text"class="form-control" class="form-control" style="width:40%">
            </div>
            <div class="form-group">
              <label for="disclaimerModified">Disclaimer</label>
              <textarea id="disclaimerModified" class="form-control" name="disclaimerModified"></textarea>
            </div>
    </div>
    <div class="span6">
      <div class="form-group">
        <label for="costModified">Cost</label>
        <input id="costModified" type="text" class="form-control" style="width:40%">
      </div>
      <div class="form-group">
        <label for="sellingPriceModified">Selling Price</label>
        <input id="sellingPriceModified" type="text" class="form-control" style="width:40%">
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

@stop