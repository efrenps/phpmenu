@extends('masterFinance')

 @section('content')

 <div class="row" id="Top">
	<div  class="col-md-3 space" >
		<div class="basePayment">
			<h4><strong>Base Payment: $375.44</strong></h4>
			<h4><strong>No Protection</strong></h4>
		</div>
	</div>
	<div  class="col-md-3 space" >
		<div class="base">
			<h5><strong>Prepared for John Smith</strong></h5>
			<h5><strong>2012 Toyota Camary LE</strong></h5>
		</div>
	</div>
	<div  class="col-md-3 space" >
		<div class="base">
			<h5><strong>Amount Financed: $18,652.17</strong></h5>
			<h5><strong>APR: 7.69</strong></h5>
			<h5><strong>Term: 60</strong></h5>
		</div>
	</div>
	<div  class="col-md-3 space" >
		<div class="base">
			<h5><strong>Down Payment: $2,000.00</strong></h5>
		</div>
	</div>
</div>
<div class="row" id="SectionTables">
	<div class="col-md-3 space">
		<div class="tables">
				<div class="header premium"><h2><strong>Premium</strong></h2></div>
				<div class="bodyTable">
						<?php $a=1; ?>
						@foreach ($Products as $Product)
									<section class="products">								
										<h4>
										<input type="checkbox" checked id="id<?php echo $a;?>">
										{{{ $Product->ProductName }}}-- ${{{ $Product->Cost }}}</h4>
										<h5>{{{ $Product->DisplayName }}}</h5>
										<ul id="sortable">
										  @foreach ($Datas as $data)
										  	@if ($data->ProductId == $a)
											    <li>{{{ $data->BulletPoint}}}</li>
											@endif							  	
										  @endforeach									  
										</ul>
										<?php $a++; ?> 	
										<?php 
											if ($a==6) {
												break;
											}
										 ?>	
									</section>	
						@endforeach
				</div>				
				<div class="footerTable">
					<h2><strong>Cost Per Day: $1.66</strong></h2>
					<h5><strong>Additional Payment: $50.23</strong></h5>
					<h5><strong>Monthly Payment: $50.23</strong></h5>
				</div>
		</div>
	</div>
	<div class="col-md-3 space">
		<div class="tables">
				<div class="header preferred"><h2><strong>Preferred</strong></h2></div>
				<div class="bodyTable">
						<?php $a=1; ?>
						@foreach ($Products as $Product)
									<section class="products">	
										<h4>
										<input type="checkbox" checked>
										{{{ $Product->ProductName }}}</h4>
										<h5>{{{ $Product->DisplayName }}}</h5>
										<ul id="sortable">
										  @foreach ($Datas as $data)
										  	@if ($data->ProductId == $a)
											    <li>{{{ $data->BulletPoint}}}</li>
											@endif							  	
										  @endforeach									  
										</ul>
										<?php $a++; ?> 	
										<?php 
											if ($a==5) {
												break;
											}
										 ?>	
									</section>            
						@endforeach
				</div>		
				<div class="footerTable">
					<h2><strong>Cost Per Day: $1.66</strong></h2>
					<h5><strong>Additional Payment: $50.23</strong></h5>
					<h5><strong>Monthly Payment: $50.23</strong></h5>
				</div>
		</div>
	</div>
	<div class="col-md-3 space">
		<div class="tables">
				<div class="header economy"><h2><strong>Economy</strong></h2></div>
				<div class="bodyTable">
						<?php $a=1; ?>
						@foreach ($Products as $Product)
									<section class="products">	
										<h4>
										<input type="checkbox" checked>
										{{{ $Product->ProductName }}}</h4>
										<h5>{{{ $Product->DisplayName }}}</h5>
										<ul id="sortable">
										  @foreach ($Datas as $data)
										  	@if ($data->ProductId == $a)
											    <li>{{{ $data->BulletPoint}}}</li>
											@endif							  	
										  @endforeach									  
										</ul>
										<?php $a++; ?> 	
										<?php 
											if ($a==4) {
												break;
											}
										 ?>	
									</section>          
						@endforeach
				</div>		
				<div class="footerTable" style="opacity:1;">
					<h2><strong>Cost Per Day: $1.66</strong></h2>
					<h5><strong>Additional Payment: $50.23</strong></h5>
					<h5><strong>Monthly Payment: $50.23</strong></h5>
				</div>
			</div>
	</div>
	<div class="col-md-3 space">
		<div class="tables" height="100%">
				<div class="header basic"><h2><strong>Basic</strong></h2></div>
				<div class="bodyTable">
					<?php $a=1; ?>
					@foreach ($Products as $Product)
								<section class="products">	
									<h4>
									<input type="checkbox" checked>
									{{{ $Product->ProductName }}}</h4>
									<h5>{{{ $Product->DisplayName }}}</h5>
									<ul id="sortable">
									  @foreach ($Datas as $data)
									  	@if ($data->ProductId == $a)
										    <li>{{{ $data->BulletPoint}}}</li>
										@endif							  	
									  @endforeach									  
									</ul>
									<?php $a++; ?> 	
									<?php 
										if ($a==3) {
											break;
										}
									 ?>	
								</section>            
					@endforeach
				</div>		
				<div class="footerTable">
					<h2><strong>Cost Per Day: $1.66</strong></h2>
					<h5><strong>Additional Payment: $50.23</strong></h5>
					<h5><strong>Monthly Payment: $50.23</strong></h5>
				</div>
		</div>
	</div>
</div>
<div class="row" id="message" style="margin-top:2%;">
	<div class="col-md-12" ><p>You are not required to buy any of the products to obtain your vehicle financing. Each of
	the optional products is described in separate documents. I understand that some products and or pricing
	made not be made available after of date delivery. In addition I assume all consequential Liability for the
	vehicle I purchased, and hold the dealership harmless as a result of my waiver of any or all coverage.</p></div>
</div>
<div class="row"id="Bottom">
	<div class="col-md-7 col-md-offset-2"><h4>Customer Signature: ___________________________________________</h4></div>
	<div class="col-md-3"><h4 style="text-align:right;">Date: 2/11/2014</h4></div>
</div>

    
 @stop


