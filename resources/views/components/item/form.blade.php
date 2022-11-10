@props(['method'=>'GET','hasFiles'=>false, 'wireSubmit'=>'submit'])
<form wire:submit.prevent="{{$wireSubmit}}" method="{{ $method !== 'GET' ? 'POST' : 'GET' }}" @isset($action) action="{{ $action }}"
      @endisset {!! $hasFiles ? 'enctype="multipart/form-data"' : '' !!} {{ $attributes }} novalidate>
    @csrf
    @method($method)
    <div class="p-5 overflow-y-auto">
            {{ $slot }}
    </div>
</form>
