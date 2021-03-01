@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    This is the edit page!
                    
                 
                    {{$contact->urlt}}
                    {{$contact->gender}}
                    {{$contact->age}}
                    
                    <form method="POST" action="{{ route('contact.update', ['id'=>$contact->id]) }}">　
                    @csrf
                    氏名
                    <input type='text' name='your_name' value={{$contact->your_name}}>
                    <br>
                    件名
                    <input type='text' name='title' value={{$contact->title}}>
                    <br>

                    メールアドレス
                    <input type='email' name='email' value={{$contact->email}}>
                    <br>
                    ホームページ
                    <input type='url' name='url' value={{$contact->url}}>
                    <br>
                    
                    性別
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="0" 
                        @if($contact->gender===0)@endif checked>
                        <label class="form-check-label">男性</label>
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="1"
                        @if($contact->gender===1)@endif checked>
                        <label class="form-check-label">女性</label>
                    </div>
                    
                    <div class="form-group">
                    <label for="age">年齢</label>
                    <select class="form-control" id="age" name="age">
                        <option value="">選択して下さい</option>
                        <option value="1" @if($contact->age===1)@endif selected>~19歳</option>
                        <option value="2" @if($contact->age===2)@endif selected>~29歳</option>
                        <option value="3" @if($contact->age===3)@endif selected>~39歳</option>
                        <option value="4" @if($contact->age===4)@endif selected>~49歳</option>
                        <option value="5" @if($contact->age===5)@endif selected>~59歳</option>
                        <option value="6" @if($contact->age===6)@endif selected>60歳~</option>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="contact">お問い合わせ内容</label>
                        <textarea class="form-control" id="contact" name="contact" rows="3">
                        {{$contact->contact}}
                        </textarea>
                    </div>
                   
                    
                    <input class="btn btn-info" type="submit" name="btn_register" value="更新する">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
