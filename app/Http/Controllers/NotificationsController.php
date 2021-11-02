<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use App\Notifications\InvoicePaid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Product;
use App\Models\User;
use App\Models\Notifications;
use Carbon\Carbon;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductsNotification;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    use  Notifiable;
    public function index()
    {

        $noleidas = auth()->user()->unreadNotifications;
        $leidas = auth()->user()->readNotifications;
        return view('notifications.index', compact('noleidas', 'leidas'));
    }
    public function getNotificationsData(Request $request)
    {   //trayendo todos los usuarios
        $users = User::all();

        //consultando la cantidad de productos stock+inventario y comparando con el valor minimo de reabastecimiento para crear notificacion
        Product::select('products.*','notifications.data->id AS jsonidproduct')->leftJoin('notifications', 'products.id', '=', 'notifications.data->id')
        ->whereNull('notifications.data->id')->whereRaw('quantity_stock  + quantity_inventory <= min_supply_quantity')->addSelect(DB::raw("'stock' as type"))->get()->each(function ($product) use ($users) {
            Notification::send($users, new ProductsNotification($product));
        });


        //buscando los productos a menos de 30 dias de vencer y creando la notificación
        $date = now()->addDays(30);
        Product::select('products.*', 'notifications.data->id AS jsonidproduct')
            ->leftJoin('notifications', 'products.id', '=', 'notifications.data->id')
            ->whereNull('notifications.data->id')
            ->where('products.due_date', '<', $date)
            ->addSelect(DB::raw("'fecha' as type"))
            ->orderBy('products.id')
            ->get()->each(function ($product) use ($users) {
                Notification::send($users, new ProductsNotification($product));
            });




        //Insertando los datos en el contenido principal.

        $dropdownHtml = '';
        $myRoute = route('markAsRead');
        $iconojo =   "<span class='float-right text-muted text-sm'> <i class='mr-2 fas fa-fw fa-eye'></i> </span>";
        $dropdownHtml .=  "<a href='{$myRoute}' class='dropdown-item'> {$iconojo} Marcar todo como leído </a>";

        foreach (auth()->user()->unreadNotifications as $key => $not) {
           

            $time = "<span class='float-right text-muted text-sm'>
                   {$not->created_at->diffForHumans()}
                 </span>";
            if($not->data['type']=="fecha"){
                $icon = "<i style='color: Tomato;'class='mr-2 fas fa-fw fa-calendar-times'></i>";
                $dropdownHtml .= "<a href='#' class='dropdown-item text-truncate'>
                            {$icon}{$not->data['name']}<br>vencerá en 30 días{$time}
                          <a/>";
            }
            if($not->data['type']=="stock"){
                $icon = "<i style='color: Tomato;'class='mr-2 fas fa-fw  fa-boxes'></i>";
                $dropdownHtml .= "<a href='#' class='dropdown-item text-truncate'>
                            {$icon}{$not->data['name']}<br>stock minímo alcanzado{$time}
                          </a>";
            }
            

            if ($key < count(auth()->user()->unreadNotifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // return a al contenido principal y al icono con las notificaciones.

        return [
            'label'       => count(auth()->user()->unreadNotifications),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];
    }

    public function markNotification(Request $request)
    {
       //marcando como leídas las notificaciones de una en una
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();
        return redirect()->back();
    }
}
