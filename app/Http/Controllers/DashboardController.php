<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\ProductsNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    use Notifiable;
    function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|borrar-producto', ['only' => ['index']]);
        $this->middleware('permission:crear-producto', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-producto', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-producto', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        // $products = Product::select('products.*','notifications.data->id','notifications.data->type')
        // ->leftJoin('notifications', 'products.id', '=', 'notifications.data->id')
        // ->whereRaw('quantity_stock  + quantity_inventory <= min_supply_quantity')
        // ->where('notifications.data->type','!=','stock')
        // ->addSelect(DB::raw("'stock' as type"))
        // ->get();

        // foreach($products as $pro){
        //     echo($pro->id);
        //     echo(',');
        // }


        $date = now()->addDays(30);
        $productosxvencer = Product::where('due_date','<', $date); 
        $produxcatego = Product::selectRaw('products.category, categories.id, categories.name, COUNT(products.category) AS countproxcate')->leftjoin('categories', 'products.category', '=', 'categories.id')->groupby('products.category')->get();
        $categories = Category::all();
        $products = Product::all();
        $user = User::all();
        return view('dash.index', compact('categories', 'products', 'user', 'produxcatego','productosxvencer'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        
    }
}
