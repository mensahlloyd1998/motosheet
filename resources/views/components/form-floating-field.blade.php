@props(['name', 'label', 'type'=>'text', 'idPrefix'=>'', 'value'=>null])

@php
    $id = $idPrefix ? $idPrefix."-".$name : $name ;
@endphp

<div class="mb-3 {{ $attributes->get('col') ?? 'col-md-4' }}">
    <div class="form-floating">
        <input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="">
        <label for="{{ $id }}">{{ $label }}</label>
    </div>
    @error($name) <p class="fs-12 text-danger">{{ $message }}</p> @enderror
</div>