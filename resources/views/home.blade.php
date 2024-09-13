@php
    $orders = config('ordermenu.orders');
@endphp

@extends('layouts.main')

@section('page_title')
    Home
@endsection

@section('jumbo')
    <section class="jumbo">
        <h1 class="title">
            Home
        </h1>
    </section>
@endsection

@section('content')
    <main>
        <section class="">
            <h2 class="title">
                Movie list
            </h2>

            <form class="movies-list-container">
                <div class="list-options-topbar">
                    <select class="order" onchange="location = this.value;">
                        @foreach ($orders as $order)
                            <option value="{{ url()->current() }}?order={{ $order['value'] }}&page=0"
                                {{ request('order') == $order['value'] ? 'selected' : null }}>
                                {{ $order['menu_text'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <ul class="movies-list">
                    @foreach ($movies as $movie)
                        <li>
                            <article class="movie-card">
                                <h3 class="movie-title">
                                    {{ $movie->original_title }}
                                </h3>

                                <span class="movie-date">
                                    {{ $movie->date }}
                                </span>

                                <strong class="movie-vote">
                                    {{ $movie->vote }}
                                </strong>
                            </article>
                        </li>
                    @endforeach
                </ul>

                <div class="list-options-bottombar">
                    <select class="pages-controller" onchange="location = this.value;">
                        @for ($i = 0; $max_page >= $i; $i++)
                            <option value="{{ url()->current() }}?order={{ request('order') }}&page={{ $i }}"
                                {{ request('page') == $i ? 'selected' : null }}>
                                {{ $i + 1 }}
                            </option>
                        @endfor
                    </select>
                </div>
            </form>
        </section>
    </main>
@endsection
