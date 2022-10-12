<div class="mb-3 form-check">
  <input type="checkbox" class="form-check-input @error($attributes->get("name")) is-invalid @enderror"
         id="{{$attributes->get("name")}}Input" name="{{$attributes->get("name")}}"
         value="1" {{ $attributes->get("value") ? 'checked' : '' }}>
  <label for="{{$attributes->get("name")}}Input" class="form-check-label">
    {{$attributes->get("label")}}
  </label>

  @error($attributes->get("name"))
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
