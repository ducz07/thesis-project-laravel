<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();



class HomeController extends Controller
{
    //home content
    public function index(){
        $all_published_product = DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
            ->where('tbl_products.publication_status',1)
            ->orderBy('product_id', 'desc')
            ->paginate(6);
        $manage_published_product=view('pages.home_content')
            ->with('all_published_product',$all_published_product);// all info put in ""all_brand_info""
        return view('layout')
            ->with('pages.home_content',$manage_published_product);
    }


// category wise product

    public function show_product_by_category($category_id){
        if (!empty($category_id)){
            $all_published_product = DB::table('tbl_products')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                ->where('tbl_products.publication_status',1)
                ->where('tbl_category.category_id',$category_id)
                ->orderBy('product_id', 'desc')
                ->paginate(6);
            $manage_published_product=view('pages.wise_by_product')
                ->with('all_published_product',$all_published_product);// all info put in ""all_brand_info""
            return view('layout')
                ->with('pages.wise_by_product',$manage_published_product);
        }
        else{
            return Redirect::to('/')->send();
        }
    }

    // category wise product
    public function show_product_by_brand($brand_id){
        if (!empty($brand_id)){
            $all_published_product = DB::table('tbl_products')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                ->where('tbl_products.publication_status',1)
                ->where('tbl_brand.brand_id',$brand_id)
                ->orderBy('product_id', 'desc')
                /* ->limit(6)*/
                ->paginate(6);
            $manage_published_product=view('pages.wise_by_product')
                ->with('all_published_product',$all_published_product);// all info put in ""all_brand_info""
            return view('layout')
                ->with('pages.wise_by_product',$manage_published_product);
        } else{
            return Redirect::to('/')->send();
        }
    }

    // select wise product details
    public function product_details($product_id){
        $details_published_product = DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
            ->where('tbl_products.publication_status',1)
            ->where('tbl_products.product_id',$product_id)
            ->first();
        $manage_published_product=view('pages.product_details')
            ->with('details_published_product',$details_published_product);// all info put in ""all_brand_info""
        return view('layout')
            ->with('pages.product_details',$manage_published_product);
    }

    //search content
    public function search(Request $request){
        $this->validate($request,[
            'search' => 'required'
        ]);
        $search = $request->search;
        $all_published_product = DB::table('tbl_products')
            ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
            ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
            ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
            ->where('tbl_products.publication_status',1)
            ->where('tbl_products.product_name','LIKE', '%' .$search. '%')
            ->orderBy('product_id', 'desc')
            ->paginate(6);
        $manage_published_product=view('pages.home_content')
            ->with('all_published_product',$all_published_product);// all info put in ""all_published_product""
        return view('layout')
            ->with('pages.home_content',$manage_published_product);
    }

    //search price range
    public function price_range(Request $request){
        $this->validate($request,[
            'price_range' => 'required'
        ]);
        $minprice = DB::table('tbl_products')
            ->min('product_price');

        $maxprice = DB::table('tbl_products')
                   ->max('product_price');

        $price_range = $request->price_range;
        if (!empty($price_range)){
            $priceRangeArr = explode( ",",$price_range);
            $start = $priceRangeArr[0];
            $end = $priceRangeArr[1];
            if( $minprice <= $start && $maxprice >= $end ) {
                $all_published_product = DB::table('tbl_products')
                    ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                    ->join('tbl_brand','tbl_products.brand_id','=','tbl_brand.brand_id')
                    ->select('tbl_products.*','tbl_category.category_name','tbl_brand.brand_name')
                    ->where('tbl_products.publication_status',1)
                    ->where('tbl_products.product_price','>=', $start)
                    ->where('tbl_products.product_price','<=', $end)
                    ->orderBy('product_id', 'desc')
                    ->paginate(6);
                $manage_published_product=view('pages.wise_by_product')
                    ->with('all_published_product',$all_published_product);// all info put in ""all_published_product""
                return view('layout')
                    ->with('pages.wise_by_product',$manage_published_product);
            }
            else{
                return Redirect::to('/')->send();
            }
        }
        else{
            return Redirect::to('/')->send();
        }
    }






}
