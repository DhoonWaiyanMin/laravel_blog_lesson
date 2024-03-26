@props(['name','value' => ''])
<x-form.input-wrapper>
    <x-form.label :name="$name"/>
    <textarea class="form-control" id="editable" name="{{$name}}" rows="4" id="{{$name}}">{!!old($name,$value)!!}</textarea>
    <x-error :error="$name"/>
</x-form.input-wrapper>