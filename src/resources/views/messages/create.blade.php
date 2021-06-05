@extends('layouts.default')

@section('pretitle', 'Messages')
@section('title', 'New Message')

@section('page')
<div class="col-md-12">
    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

    <div class="card">
        <form method="POST" action="{{ route('messages.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group mb-3 ">
                    <label class="form-label">Email address</label>
                    <div>
                        <select class="form-select" name="addressee" value="{{ old('addressee') }}" required autofocus>
                            @foreach($friends as $friend)
                                <option value="{{ $friend->email }}" @if (request()->get('to') == $friend->email) selected @endif>{{ $friend->name }} &lt;{{ $friend->email }}&gt;</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Your message <span class="form-label-description"><span id="chars">0</span>/140</span></label>
                    <textarea class="form-control" placeholder="Type something…" style="height: 116px;" name="text" required onkeydown="charscounter(this.value)" maxlength="140">{{ old('text') }}</textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Text Color</label>
                        <div class="row g-2">
                            <div class="col-auto">
                                <label class="form-colorinput form-colorinput-light">
                                    <input name="text-color" type="radio" value="white" class="form-colorinput-input" checked="">
                                    <span class="form-colorinput-color bg-white"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="blue" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-blue"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="purple" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-purple"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="pink" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-pink"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="red" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-red"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="orange" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-orange"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="yellow" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-yellow"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="lime" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-lime"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="text-color" type="radio" value="black" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-dark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Background Color</label>
                        <div class="row g-2">
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="black" class="form-colorinput-input" checked="">
                                    <span class="form-colorinput-color bg-dark"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="blue" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-blue"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="purple" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-purple"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="pink" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-pink"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="red" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-red"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="orange" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-orange"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="yellow" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-yellow"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput">
                                    <input name="bg-color" type="radio" value="lime" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-lime"></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="form-colorinput form-colorinput-light">
                                    <input name="bg-color" type="radio" value="white" class="form-colorinput-input">
                                    <span class="form-colorinput-color bg-white"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="accordion" id="accordion-example">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-1" aria-expanded="false">
                                Settings
                            </button>
                        </h2>
                        <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordion-example" style="">
                            <div class="accordion-body pt-0">
                                <div class="py-2">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Send delay</label>
                                                <select name="delay" class="form-select">
                                                    <option value="0">Immediately</option>
                                                    <option value="10m">10 Minutes</option>
                                                    <option value="10m">30 Minutes</option>
                                                    <option value="1h">1 Hour</option>
                                                    <option value="2h">2 Hour</option>
                                                    <option value="2h">6 Hour</option>
                                                    <option value="tomorrow">Tomorrow</option>
                                                    <option value="tomorrow">Next week</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <a href="{{ url()->previous() }}" class="btn btn-link">Cancel</a>
                    <button type="submit" class="btn btn-primary ms-auto">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var textarea = document.getElementById('text');
    var el = document.getElementById('chars');
    function charscounter(str) {
        var lng = str.length;
        el.innerHTML = lng;
    }
</script>
@endsection
