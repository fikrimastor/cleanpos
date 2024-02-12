@props(['disabled' => false, 'placeholder' => null, 'rows' => null])

<textarea
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
    'class' => 'py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600',
    'placeholder' => $placeholder ?? 'Type your message...',
    'rows' => $rows ?? 6,
    ]) !!}
></textarea>
