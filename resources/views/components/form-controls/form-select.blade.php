@php
  $isMultiple = isset($multiple) && $multiple;
  $selectName = $isMultiple ? $attributes->get('name') . "[]" : $attributes->get('name');
  $errorName = $isMultiple ? $attributes->get('name') . ".*" : $attributes->get('name');
@endphp

<div class="mb-3">
  <label for="{{$attributes->get('name')}}Select" class="form-label">
    {{$attributes->get('label')}}
  </label>

  <div class="dropdown">
    <button class="form-select text-start text-truncate @error($errorName) is-invalid @enderror"
            type="button" id="{{$attributes->get('name')}}Select"
            data-bs-toggle="dropdown"
            data-bs-auto-close="outside"
            aria-expanded="false">
      {{ $attributes->get('value') ?? 'Seleziona...' }}
    </button>

    @error($errorName)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror

    <ul class="dropdown-menu" aria-labelledby="{{$attributes->get('name')}}Select">
      @if($isMultiple)
        <li>
          <button class="dropdown-item" type="button" data-dd-action="none">Nessuna</button>
        </li>
        <li>
          <button class="dropdown-item" type="button" data-dd-action="all">Tutte</button>
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>
      @endif

      @foreach($attributes->get('options') ?? [] as $option)
        @php
          $optionValue = $attributes->has("optionsKey") ? $option[$attributes->get("optionsKey")] : $option["value"];
          $optionLabel = $attributes->has("optionsText") && $attributes->get("optionsText")->has("fn") ?
            $attributes->get("optionsText")->get("fn")($option) : $option["text"] ;
          $selected = $attributes->get("value") === $optionValue;

          if(is_array($attributes->get("value"))){
            $selected = in_array($optionValue, $value);
          }
        @endphp
        <li class="dropdown-item">
          <div class="form-check">
            <input class="form-check-input"
                   type="{{$isMultiple ? 'checkbox' : 'radio'}}"
                   id="{{$selectName}}_{{$optionValue}}_option"
                   name="{{$selectName}}"
                   value="{{$optionValue}}" {{ $selected ? "checked" : '' }}>
            <label class="form-check-label" for="{{$selectName}}_{{$optionValue}}_option">
              {{ $optionLabel }}
            </label>
          </div>
        </li>
      @endforeach

    </ul>
  </div>
</div>
