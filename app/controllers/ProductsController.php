<?php

class ProductsController extends BaseController {

	/**
	 * Product Repository
	 *
	 * @var Product
	 */
	protected $Product;

	public function __construct(Product $Product)
	{
		$this->Product = $Product;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function get_ShowProductsViews()
	{
        $data = array();
        $Products = DB::table('Products')
         	               ->get();

        $ProductDetail = DB::table('ProductDetail')
         	               ->get();

        $PlansProducts = DB::table('PlansProducts')
         	               ->get();

         return View::make('financemenu')->with('Products', $Products)
                               ->with('Datas', $ProductDetail)
                               ->with('PlansProducts', $PlansProducts);
     }

     public function get_settings()
	{
		
		return 'settings';
	}
	
	public function get_index()
	{
		$Products = $this->Product->all();

		return View::make('Products.index', compact('Products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Products.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Product::$rules);

		if ($validation->passes())
		{
			$this->Product->create($input);

			return Redirect::route('Products.index');
		}

		return Redirect::route('Products.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$Product = $this->Product->findOrFail($id);

		return View::make('Products.show', compact('Product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$Product = $this->Product->find($id);

		if (is_null($Product))
		{
			return Redirect::route('Products.index');
		}

		return View::make('Products.edit', compact('Product'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Product::$rules);

		if ($validation->passes())
		{
			$Product = $this->Product->find($id);
			$Product->update($input);

			return Redirect::route('Products.show', $id);
		}

		return Redirect::route('Products.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->Product->find($id)->delete();

		return Redirect::route('Products.index');
	}

	public function show_settingsPage()
	{
        $Products = DB::select( DB::raw("SELECT id, ProductName FROM Products"));
        $Companies = DB::select( DB::raw("SELECT id, CompanyName FROM Company"));

		return View::make('settings')->with('Products', $Products)
		                             ->with('Companies', $Companies);
	}

	public function get_infoProduct()
	{
		$ProductId = Input::get('ProductId');
        $data = array();

		$Product = DB::table('Products')
		                ->where('id', '=', $ProductId)
		                ->first();
         
         $data[] = array('ProductName' => $Product->ProductName,
         		           'DisplayName' => $Product->DisplayName,
         		           'Cost' => $Product->Cost,
         		           'SellingPrice' => $Product->SellingPrice);

            $ProductDetail = DB::table('ProductDetail')
         	               ->where('ProductId', '=', $Product->id)
         	               ->get();
            
            foreach( $ProductDetail as $Detail => $DetailInfo ){
                    $data[]['Bullets'] = $DetailInfo->BulletPoint;
            }       	

	     return json_encode($data);
	}

	public function insert_productInfo(){
		$ProductName = Input::get('ProductName');
		$CompanyId = Input::get('CompanyId');
		$DisplayName = Input::get('displayName');
		$Bullet1 = Input::get('bulletPoint1');
		$Bullet2 = Input::get('bulletPoint2');
		$Bullet3 = Input::get('bulletPoint3');
		$Bullet4 = Input::get('bulletPoint4');
		$Bullet5 = Input::get('bulletPoint5');

		$Disclaimer = Input::get('disclaimer');
		$Cost = Input::get('cost');
		$SellingPrice = Input::get('sellingPrice');

		$id = DB::table('Products')
                ->insertGetId(array('CompanyId' => $CompanyId,
                   'ProductName' => $ProductName,
                   'DisplayName' => $DisplayName,
                   'Cost' => $Cost,
                   'Disclaimer' => $Disclaimer,
                   'SellingPrice' => $SellingPrice));
        
        if ($Bullet1) {
        $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $id,
                   'BulletPoint' => $Bullet1));
        }

        if ($Bullet2) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $id,
                   'BulletPoint' => $Bullet2));
        }

        if ($Bullet3) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $id,
                   'BulletPoint' => $Bullet3));
        }

        if ($Bullet4) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $id,
                   'BulletPoint' => $Bullet4));
        }

        if ($Bullet5) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $id,
                   'BulletPoint' => $Bullet5));
        }

        return "The product has been added";
	}

	public function update_productInfo()
	{
		$ProductId = Input::get('ProductId');
		$ProductName = Input::get('ProductName');
		$CompanyId = Input::get('CompanyId');
		$DisplayName = Input::get('displayName');
		$Bullet1 = Input::get('bulletPoint1');
		$Bullet2 = Input::get('bulletPoint2');
		$Bullet3 = Input::get('bulletPoint3');
		$Bullet4 = Input::get('bulletPoint4');
		$Bullet5 = Input::get('bulletPoint5');

		$Disclaimer = Input::get('disclaimer');
		$Cost = Input::get('cost');
		$SellingPrice = Input::get('sellingPrice');

		$ProductUpdated = DB::table('Products')
                ->where('id', $ProductId)
                ->update(array('CompanyId' => $CompanyId,
                   'ProductName' => $ProductName,
                   'DisplayName' => $DisplayName,
                   'Disclaimer' => $Disclaimer,
                   'Cost' => $Cost,
                   'SellingPrice' => $SellingPrice));
        
        DB::table('ProductDetail')->where('ProductId', '=', $ProductId)->delete();
        
        if ($Bullet1) {
        $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $ProductId,
                   'BulletPoint' => $Bullet1));
        }

        if ($Bullet2) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $ProductId,
                   'BulletPoint' => $Bullet2));
        }

        if ($Bullet3) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $ProductId,
                   'BulletPoint' => $Bullet3));
        }

        if ($Bullet4) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $ProductId,
                   'BulletPoint' => $Bullet4));
        }

        if ($Bullet5) {
            $DetailProduct = DB::table('ProductDetail')
                ->insert(array('ProductId' => $ProductId,
                   'BulletPoint' => $Bullet5));
        }
        
        return "The product info has been updated";
	}

	public function deletProduct(){

	}

	public function get_ShowProducts()
	{
		$data = array();

        $Products = $this->Product->all();

        foreach($Products as $product => $ProductInfo){

            $data[] = array('ProductId' => $ProductInfo->id,
            	           'ProductName' => $ProductInfo->ProductName,
         		           'DisplayName' => $ProductInfo->DisplayName,
         		           'Cost' => $ProductInfo->Cost,
         		           'SellingPrice' => $ProductInfo->SellingPrice);

         	$ProductDetail = DB::table('ProductDetail')
         	               ->where('ProductId', '=', $ProductInfo->id)
         	               ->get();
            
            foreach( $ProductDetail as $Detail => $DetailInfo ){
                $data[]['Bullets'] = $DetailInfo->BulletPoint;
            }

            $Companies = DB::table('Company')
                        ->where('id', '=', $ProductInfo->CompanyId)
                        ->get();
            
            foreach ($Companies as $Company => $CompanyInfo) {
            	$data[]['Company'] = $CompanyInfo->CompanyName;
            }
         }
 
         return json_encode($data);
	}

                               
    public function get_TableData(){      
        $Products = DB::table('Products')
        				   ->join('PlansProducts', 'Products.id', '=', 'PlansProducts.ProductId')
        				   ->where('PlansProducts.PlansId', '=', 1)
        				   ->orderBy('PlansProducts.Order', 'asc')        				   
         	               ->get();
        $ProductDetail = DB::table('ProductDetail')
         	               ->get();

        //$PlansProducts = DB::table('PlansProducts')
         //	               ->get();  

        $Company= DB::table('Company')
         	               ->get();  

        $Products2 = DB::select(DB::raw("select *
					from Products
					left join PlansProducts
					on Products.id = PlansProducts.ProductId
					where PlansProducts.PlansId != 1 or PlansProducts.PlansId is null
					"));/*DB::table('Products')
        				   ->leftjoin('PlansProducts', 'Products.id', '=', 'PlansProducts.ProductId')
        				   ->where('PlansProducts.PlansId', '!=', 1)
        				   //->orWhere('PlansProducts.PlansId', '=', DB::raw('null'))
        				   ->get();*/
        //$Products2= array_unique($Products2);	      
        //return json_encode($Products2);
        $table = '<table class="table table-striped">
	      <thead>
	        <tr>
	          <th>#</th>
	          <th>Company</th>
	          <th>Product Name</th>
	          <th>Bullets Points</th>
	          <th>Cost</th>
	          <th>Selling Price</th>
	          <th></th>
	        </tr>
	      </thead>
	      <tbody>';

	      foreach ($Products as $PlansProduct => $Plans) {
	      		if ($Plans->PlansId == 1) {
	      			$ProductContainerPlan = $Plans->ProductId;
	      			foreach ($Products as $Product => $ProductInfo) {
	      				if ($ProductInfo->id == $ProductContainerPlan) {
	      						$ProductContainerCompany = $ProductInfo->CompanyId;
	      						$ProductDisplayName = $ProductInfo->DisplayName;
	      						$ProductCost = $ProductInfo->Cost;
	      						$ProductSelling = $ProductInfo->SellingPrice;
	      						$ProductName = $ProductInfo->ProductName;
	      						foreach ($Company as $CompanyKey => $CompanyInfo) {
	      							if ($CompanyInfo->id == $ProductContainerCompany) {
	      								$productCompanyName = $CompanyInfo->CompanyName;
	      							}
	      						}


	      						//Start Print Table
	      						$table .= '<tr>
						          <td ><input type="checkbox" checked  name="productRef' . $ProductInfo->id . '" id="' . $ProductInfo->id . '" value="' . $ProductInfo->id . '  class="m" "></td>
						          <td>' . $productCompanyName . '</td>
						          <td><a href="#" data-toggle="modal" name="' . $ProductInfo->id . '" data-target="#modifiedProduct" class="modify">' . $ProductName. '</a></td>
						          <td>' . $ProductDisplayName. '<br/>';
						          $table .= '<ul>';
						          foreach ($ProductDetail as $ProductDetailkey => $ProductDetailInfo) {
						          		if ($ProductDetailInfo->ProductId == $ProductInfo->id) {
						          					$table .= '<li>' . $ProductDetailInfo->BulletPoint . '</li>';
						          			}									          	
						          }									          
						          $table .= '</ul>';
						          $table .= '</td>
						          <td>' . $ProductCost. '</td>
						          <td>' . $ProductSelling. '</td>
						          <td></td>
						        </tr>
						        '; 
						      //End Print Table	      			
	      					
	      				}//endif
	      			}//end foreach

	      			
	      		}//end If
	      }//Endfor each
	       //Append Product Not Included in Plan
	      $dataSave =array();
	      $i = 0;
	      foreach ($Products2 as $Products2key => $Products2value) {
	      		$flag = 0;
	      		$ProdcutEvaluated = $Products2value->id;
	      		foreach ($Products as $Product => $ProductInfo) {
	      			if ($ProductInfo->id == $ProdcutEvaluated ) {
	      				$flag =1;
	      			}//end if
	      		}//for each
	      		foreach ($dataSave as $key => $value){
				    if ($value == $Products2value->id) {
				        $flag =1;
				    }
				}
	      		if ($flag == 0) {
	      						$dataSave[$i] = $Products2value->id;
	      						$i = $i +1;
	      						$ProductContainerCompany = $Products2value->CompanyId;
	      						$ProductDisplayName = $Products2value->DisplayName;
	      						$ProductCost = $Products2value->Cost;
	      						$ProductSelling = $Products2value->SellingPrice;
	      						$ProductName = $Products2value->ProductName;
	      						foreach ($Company as $CompanyKey => $CompanyInfo) {
	      							if ($CompanyInfo->id == $ProductContainerCompany) {
	      								$productCompanyName = $CompanyInfo->CompanyName;
	      							}
	      						}
	      						//Start Print Table
	      						$table .= '<tr>
						          <td><input type="checkbox" name="productRef' . $Products2value->id . '" id="' . $Products2value->id . '" value="' . $Products2value->id . '"></td>
						          <td>' . $productCompanyName . '</td>
						          <td><a href="#" data-toggle="modal" name="' . $Products2value->id . '" data-target="#modifiedProduct" class="modify">' . $ProductName. '</a></td>
						          <td>' . $ProductDisplayName. '<br/>';
						          $table .= '<ul>';
						          foreach ($ProductDetail as $ProductDetailkey => $ProductDetailInfo) {
						          		if ($ProductDetailInfo->ProductId == $Products2value->id) {
						          					$table .= '<li>' . $ProductDetailInfo->BulletPoint . '</li>';
						          			}									          	
						          }									          
						          $table .= '</ul>';
						          $table .= '</td>
						          <td>' . $ProductCost. '</td>
						          <td>' . $ProductSelling. '</td>
						          <td><button type="button" class="btn btn-danger" value="' . $Products2value->id .'">Delete</button></td>
						        </tr>
						        '; 
						      //End Print Table	      			

	      		}//end if		
	      }//End for each
	      $table .= '</tbody>
						      </table>';


	      return $table;
    }

    public function get_SortableTableData()
    {
        $Products = DB::table('Products')
        				   ->join('PlansProducts', 'Products.id', '=', 'PlansProducts.ProductId')
        				   ->where('PlansProducts.PlansId', '=', 1)
        				   ->orderBy('PlansProducts.Order', 'asc')        				   
         	               ->get();

        $ProductDetail = DB::table('ProductDetail')
         	               ->get();

        $Company= DB::table('Company')
         	               ->get(); 

        $PlansList = DB::table('Plans')
         	               ->get(); 

        foreach ($PlansList as $PlansListkey => $PlansListvalue) {
			if ($PlansListvalue->PlanId == 1) {
				$PlansName = $PlansListvalue->PlanName;
			}
		}
   
	    $table = '<div class="tables">
	    		  <div class="header '.$PlansName . '"><h2><strong>'.$PlansName . '</strong></h2></div>
				  <div class="sortable bodyTable">';
	      			
         foreach ($Products as $PlansProduct => $Plans) {
	      		if ($Plans->PlansId == 1) {
	      			$ProductContainerPlan = $Plans->ProductId;	      			
	      			foreach ($Products as $Product => $ProductInfo) {
	      				if ($ProductInfo->id == $ProductContainerPlan) {
	      						$ProductDisplayName = $ProductInfo->DisplayName;
	      						$ProductCost = $ProductInfo->Cost;
	      						$ProductName = $ProductInfo->ProductName;
	      						
	      						//Start Print Table
	      						$table .= '<li id='.$ProductInfo->id.'>										
										    <h4>'.$ProductName.'--'.$ProductCost.'</h4>';

								$table.= '<h5>'.$ProductDisplayName.'</h5>';

								foreach ($ProductDetail as $ProductDetailkey => $ProductDetailInfo) {
						          		if ($ProductDetailInfo->ProductId == $ProductInfo->id) {
						          					$table .= '<br>' . $ProductDetailInfo->BulletPoint;
						          			}									          	
						          }	

						          $table.= '</li>';
	      						//End Print Table      						
	      					
	      				}//endif
	      			}//enf foreach

	      		}//end If
	      }//Endfor each
	      
	      $table.='</div>
	      			 </div>';

	      return $table;
     }

      public function get_UpdateOrderProducts()
      {
      		$Order = Input::get('Order');
      		$ProductId = Input::get('ProductId');
      		$PlansId = Input::get('PlansId');


      		DB::table('PlansProducts')
	            ->where('PlansId', '=', $PlansId)
	            ->where('ProductId', '=', $ProductId)
	            ->update(array('Order' => $Order));
        
        	return '1';
      }

      public function get_deleteTable()
      {
      	$ProductId = Input::get('id');
      	$PlansId = 1;

      	DB::table('PlansProducts')
      		->where('PlansId', '=', $PlansId)
	        ->where('ProductId', '=', $ProductId)
      		->delete();
		
      	return '1';	
      }

      public function get_InsertTable()
      {
      	$ProductId = Input::get('id');
      	$PlansId = 1;

      	$Validate = DB::table('PlansProducts')
                    ->where('PlansId', '=', $PlansId)
	        		->where('ProductId', '=', $ProductId)
                    ->get();


         if (!empty($Validate )) {
         	return '0';
         }

      	$table = DB::table('PlansProducts')
                    ->where('PlansId', '=', $PlansId)
	        		->orderBy('Order', 'desc')
                    ->get();

         foreach ($table as $tablekey => $tablevalue) {
         	$maxId = $tablevalue->Order;
         }
        $maxId = $maxId + 1;
      	DB::table('PlansProducts')
      		->insert(
		    array('PlansId' => $PlansId, 'ProductId' => $ProductId,'Order' => $maxId )
			);
		return '1';
      		
      }

    public function createCompany()
    {
    	$CompanyName = Input::get('CompanyName');

    	$Company = DB::table('Company')
    	           ->insert(array('CompanyName' => $CompanyName));

    	return "Company " . $CompanyName . " has been added";
    }

    public function populateCompanyList()
    {
        $Companies = DB::select( DB::raw("SELECT id, CompanyName FROM Company"));

    	$list = '<select name="CompanyId" id="CompanyId">';
        foreach ($Companies as $Company => $CompanyInfo) {
      	  $list .= '<option value="' . $CompanyInfo->id . '">' . $CompanyInfo->CompanyName . '</option>';
        }
         
        $list .= '</select>';

        return $list;

    }

    public function deleteProduct() 
    {
    	$ProductId = Input::get('ProductId');

    	$DeletedProduct = DB::table('Products')->where('id', '=', $ProductId)->delete();

    	return 'The product has been removed';
    }
}