@props(['name','type'=>'text'])
<x-form.input-wrapper>
    <x-form.label :name="$name"></x-form.label>
    <input id="{{ $name }}"  type="{{ $type }}" name="{{ $name }}" class="form-control" value="{{ old($name) }}">

    <x-error :name="$name"></x-error>
</x-form.input-wrapper>