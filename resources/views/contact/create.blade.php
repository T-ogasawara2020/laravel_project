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

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul> 
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    You are alowed to create!
                    <form method="POST" action="{{route('contact.store')}}">　
                    @csrf
                    氏名
                    <input type='text' name='your_name'>
                    <br>
                    件名
                    <input type='text' name='title'>
                    <br>

                    メールアドレス
                    <input type='email' name='email'>
                    <br>
                    ホームページ
                    <input type='url' name='url'>
                    <br>
                    
                    性別
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="0" >
                        <label class="form-check-label">男性</label>
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="1">
                        <label class="form-check-label">女性</label>
                    </div>
                    
                    <div class="form-group">
                    <label for="age">年齢</label>
                    <select class="form-control" id="age" name="age">
                        <option value="">選択して下さい</option>
                        <option value="1">~19歳</option>
                        <option value="2">~29歳</option>
                        <option value="3">~39歳</option>
                        <option value="4">~49歳</option>
                        <option value="5">~59歳</option>
                        <option value="6">60歳~</option>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="contact">お問い合わせ内容</label>
                        <textarea class="form-control" id="contact" name="contact" rows="3">
                        </textarea>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="caution" value="1" id="caution">
                        <label class="form-check-label" for="caution">
                            注意事項を確認
                        </label>
                    </div>
                    
                    <input class="btn btn-info" type="submit" name="btn_register" value="登録する">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
