<div class="mb-3">
  <label for="{{$attributes->get("name")}}Input" class="form-label">
    {{$attributes->get("label")}}
  </label>
  <input type="{{ $attributes->get("type") ?? 'text'  }}"
         class="form-control @error($attributes->get("name")) is-invalid @enderror"
         @if(isset($accept)) accept="{{$accept}}" @endif
         id="{{$attributes->get("name")}}Input"
         name="{{$attributes->get("name")}}"
         value="{{ $attributes->get("value") }}">
  @error($attributes->get("name"))
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
