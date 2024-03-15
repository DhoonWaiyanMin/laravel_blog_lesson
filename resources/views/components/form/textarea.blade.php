@props(['name'])
<x-form.input-wrapper>
    <x-form.label :name="$name"/>
    <textarea class="form-control" name="{{$name}}" rows="4" id="{{$name}}">{{old($name)}}</textarea>
    <x-error :error="$name"/>
</x-form.input-wrapper>