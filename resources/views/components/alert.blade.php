@props(['type' => 'success','message' => ''])

@php
    $border = $type === 'success' ? '#86efac' : '#fca5a5';
    $bg = $type === 'success' ? '#f0fdf4' : '#fef2f2';
@endphp


<div class="card" style="border-color: {{ $border }}; background: {{ $bg }}; margin-bottom: 14px">
    <strong style="text-transform: uppercase; font-size: 12px;">
        {{ $type === 'success' ? 'OK' : 'INFO' }}
    </strong>
    <div style="margin-top: 6px"> {{ $message }} </div>
</div>
