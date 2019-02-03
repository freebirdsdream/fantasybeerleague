<div class="mb-4">
	<div class="text-black font-bold text-l mb-2">{{ $placeholder }}</div>
	@if($errors->count() && isset($errors->messages()[$name]))
		<div class="text-red-dark">
			{{ $errors->messages()[$name][0] }}
		</div>
	@endif
	<textarea rows=30 class="shadow appearance-none border @if($errors->count() && isset($errors->messages()[$name])) border-red-dark @endif rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="{{ $name }}">{{ $text }}</textarea>
</div>