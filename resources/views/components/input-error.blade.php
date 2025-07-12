@props(['messages'])
@if ($messages)
    <div {{ $attributes->merge(['class' => 'mb-4 p-4 bg-red-50 border border-red-200 rounded-lg']) }}>
        <ul class="text-sm text-red-600 space-y-1">
            @foreach ((array) $messages as $message)
                {{ $message }}
            @endforeach
        </ul>
    </div>
@endif