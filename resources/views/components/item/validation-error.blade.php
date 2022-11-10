@props(['name'=>''])
@error($name)
<p class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">{{ $message }}</p>
@enderror

