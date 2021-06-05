@extends('layouts.default')

@section('pretitle', 'Messages')
@section('title', 'New Message')

@section('page')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="form-group mb-3">
                <label class="form-label">Your message</label>
                <textarea class="form-control" placeholder="Type something…" style="height: 116px;" name="text" required
                    onkeypress="charscounter(this.value)" maxlength="140"></textarea>
                <small class="form-hint"><span id="chars">0</span>/140</small>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex">
                <a href="{{ url()->previous() }}" class="btn btn-link">Cancel</a>
            </div>
        </div>
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
