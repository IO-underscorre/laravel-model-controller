<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class PageController extends Controller
{
    public function movies(Request $request)
    {
        $current_page = $request->get('page');

        $movies_count = Movie::count();
        $max_page = ceil($movies_count / 5) - 1;

        if ($current_page < 0 || !isset($current_page)) {
            $current_page = 0;
        } elseif ($current_page > $max_page) {
            $current_page = $max_page;
        }

        $order_string = $request->get('order');

        $order_strings_accepted = [];
        foreach (config('ordermenu.orders') as $accepted_order) {
            $order_strings_accepted[] = $accepted_order['value'];
        }

        if (in_array($order_string, $order_strings_accepted, true)) {
            $order_by = $order_string;
        } else {
            $order_by = 'id';
        }

        $movies = Movie::orderBy($order_by)->skip($current_page * 5)->limit(5)->get();

        return view('home', compact('movies', 'current_page', 'max_page'));
    }

    public function movieDetail($id)
    {
        $selected_movie = Movie::find($id);

        return view('home', compact('selected_movie'));
    }
}
