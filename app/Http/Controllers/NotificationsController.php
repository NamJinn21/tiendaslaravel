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
    {

        $date = now()->addDays(30);
        $users = User::all();
        Product::select('products.*', 'notifications.data->id AS jsonidproduct')
            ->leftJoin('notifications', 'products.id', '=', 'notifications.data->id')
            ->whereNull('notifications.data->id')
            ->where('products.due_date', '<', $date)
            ->orderBy('products.id')
            ->get()->each(function ($product) use ($users) {
                Notification::send($users, new ProductsNotification($product));
            });

        // Product::where('due_date', '<', $date)->get()->each(function ($product) use ($users) {
        //     Notification::send($users, new ProductsNotification($product));
        // });



        //Insertando los datos en el contenido principal.

        $dropdownHtml = '';
        $iconojo =   "<span class='float-right text-muted text-sm'> <i class='mr-2 fas fa-fw fa-eye'></i> </span>";
        $dropdownHtml .=  "<a href='{route('viewnotification')}' class='dropdown-item'> {$iconojo} Marcar todo como leído </a>";

        foreach (auth()->user()->unreadNotifications as $key => $not) {
            $icon = "<i style='color: Tomato;'class='mr-2 fas fa-fw fa-exclamation'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                   {$not->created_at->diffForHumans()}
                 </span>";

            $dropdownHtml .= "<a href='#' class='dropdown-item'>
                            {$icon}{$not->data['name']}{$time}
                          </a>";

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
       
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();
        return redirect()->back();
    }
}
