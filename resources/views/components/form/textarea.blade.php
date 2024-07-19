@props(['name'])
<x-form.input-wrapper>
    <x-form.label :name="$name"></x-form.label>
    <textarea id="{{ $name }}" class="form-control" name="{{ $name }}" id="" cols="30" rows="10">{{ old($name) }}</textarea>

    <x-error name="{{ $name }}"></x-error>
</x-form.input-wrapper>