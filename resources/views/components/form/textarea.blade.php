@props(['name','value'=>''])
<x-form.input-wrapper>
    <x-form.label :name="$name"></x-form.label>
    <textarea id="{{ $name }} editor" class="form-control" name="{{ $name }}" id="" cols="30" rows="10">{{ old($name,$value) }}</textarea>

    <x-error name="{{ $name }}"></x-error>
</x-form.input-wrapper>