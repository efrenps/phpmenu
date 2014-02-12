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

        $Products = $this->Product->all();
        
        foreach($Products as $product => $ProductInfo){

            $data[] = array('ProductName' => $ProductInfo->ProductName,
         		           'DisplayName' => $ProductInfo->DisplayName,
         		           'Cost' => $ProductInfo->Cost,
         		           'SellingPrice' => $ProductInfo->SellingPrice);

         	$ProductDetail = DB::table('ProductDetail')
         	               ->get();
            
            
         } 
         //return View::make('', compact('Products'));
         return View::make('financemenu')->with('Products', $Products)
                               ->with('Datas', $ProductDetail);
     }

     public function get_settings()
	{
		
		return 'settings';
	}
    //88888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
                               
	
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

	public function show_settingsPage(){
		$Companies = DB::select( DB::raw("SELECT id, CompanyName FROM Company"));
        $Products = DB::select( DB::raw("SELECT id, ProductName FROM Products"));

		return View::make('settings')->with('Companies', $Companies)
		                             ->with('Products', $Products);
	}

	public function get_infoProduct(){
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

		$disclaimer = Input::get('disclaimer');
		$Cost = Input::get('cost');
		$SellingPrice = Input::get('sellingPrice');

		$id = DB::table('Products')
                ->insertGetId(array('CompanyId' => $CompanyId,
                   'ProductName' => $ProductName,
                   'DisplayName' => $DisplayName,
                   'Cost' => $Cost,
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

}
