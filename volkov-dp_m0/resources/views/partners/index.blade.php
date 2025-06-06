@extends('layouts.layout')
@section('title', 'Партнеры')
@section('content')
    <div class="nav">
        <a class="btn" href="{{route('partners.create')}}">Создать партнера</a>
        <a class="btn" href="{{ route('home') }}">← Назад</a>
    </div>
    <div class="external border">
        @foreach ($partners as $partner)
                <div class="internal border">
                    <div class="internal-in">
                        <a href="{{ route('partners.edit', $partner->id) }}">
                        <h2 class="internal-in-h"> {{ $partner->partnerType->name }} | {{$partner->name}}</h2>
                        </a>
                        <div> {{$partner->address}}</div>
                        <div> +7 {{$partner->phone}}</div>
                        <div> Рейтинг: {{$partner->rating}}</div>
                    </div>
                    <div>
                        <h2>{{ number_format($partner->total_cost, 2, '.', ' ') }}</h2>
                    </div>
                </div>
            <a href="{{ route('partners.products', $partner->id) }}">Предлагаемая продукция партнёру *клик*</a>
        @endforeach
    </div>
@endsection
