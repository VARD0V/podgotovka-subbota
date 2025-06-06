@extends('layouts.layout')
@section('title', 'Создание партнера')
@section('content')
    <h2>Создание партнёра</h2>
    <form action="{{ route('partners.store')}}" method="post" enctype="application/x-www-form-urlencoded">
        @csrf
        <div class="form">
            <label>Тип:</label>
            <select name="type_id" required>
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
            <label for="director">Директор</label>
            <input type="text" name="director" >
            <label for="name">Название</label>
            <input type="text" name="name" >
            <label for="email">Почта</label>
            <input type="email" name="email">
            <label for="phone">Телефон</label>
            <input type="text" name="phone">
            <label for="address">Адрес</label>
            <input type="text" name="address" >
            <label for="inn">ИНН</label>
            <input type="text" name="inn" >
            <label for="rating">Рейтинг</label>
            <input type="number" min="1" max="10" name="rating">
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="btn" type="submit">Создать</button>
    </form>
    <a href="{{route('partners.index')}}">Назад к списку</a>
@endsection
