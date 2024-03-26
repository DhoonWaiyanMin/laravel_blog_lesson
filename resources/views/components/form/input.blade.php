@props(['name','type'=>'text','value' => ''])
<x-form.input-wrapper>
    <x-form.label :name="$name"/>
    <input type="{{$type}}" class="form-control" name="{{$name}}" id="{{$name}}" value="{{ old($name,$value) }}">
    <x-error :error="$name"/>
</x-form.input-wrapper>