@extends('layout')

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    init({});
  });

</script>
<script src="{{ asset('js/search-form.js') }}"></script>
@endsection

@section('content')
<div class="container">
  <div class="row content__body">

    <div class="col-md-4">
      <h3>
        Bước 1:
        <span>Chọn nhà sản xuất</span>
      </h3>
      <div class="scroll">
        @foreach($maker as $maker)
        <div class="element">
          <input type="radio" {{ $maker->active ? 'checked' : '' }} name="vehicle--maker" value="{{ $maker->id }}">
          <label>{{ $maker->name_en }}</label>
        </div>
        @endforeach
      </div>
    </div>

    <div class="col-md-4">
      <h3>
        Bước 2:
        <span>Chọn nhà phương tiện</span>
      </h3>
      <div class="scroll2">
        <div class="initial">
          @foreach($initials as $initial)
          <div class="{{ isset($initial['class']) ? $initial['class'] : '' }} initial">
            <input type="radio" name="vehicle--initial" id="initial_{{ $initial['name'] }}" value="{{ $initial['name'] }}">
            <label for="initial_{{ $initial['name'] }}">{{ $initial['name'] }}</label>
          </div>
          @endforeach
        </div>
        <div class="vehicle--box">
        </div>
      </div>
    </div>

    <div class="col-md-4 step3">
      <h3>
        Bước 3:
        <span>Chọn một mô hình</span>
      </h3>
      <div class="scroll">
        <div class="model--box">
        </div>
      </div>
    </div>
  </div>
  @component('lazyLoading.loading_img');
  @endcomponent
</div>
@endsection
