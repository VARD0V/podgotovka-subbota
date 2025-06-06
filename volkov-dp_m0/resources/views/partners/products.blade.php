@extends('layouts.layout')
@section('title', 'Продукция партнёру')
@section('content')
    <div class="nav">
        <a class="btn" href="{{ route('partners.index') }}">← Назад</a>
    </div>
    <h3>{{$partner->name}} | {{$partner->partnerType->name}}</h3>
    @if($partner_products->isEmpty())
        <p>Увы тут пусто.</p>
    @else
        @foreach($partner_products as $partner_product)
            <div class="internal-in border">
                <div>Название: {{ $partner_product->product->name }}</div>
                <div>Минимальная цена: {{ $partner_product->product->minimal_cost }}</div>
                <div>Кол-во: {{ $partner_product->amount }}</div>
            </div>
        @endforeach
    @endif
@endsection
