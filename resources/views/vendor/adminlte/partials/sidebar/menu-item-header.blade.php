<li @isset($item['id']) id="{{ $item['id'] }}" @endisset


style="font-size: 16px; font-weight: bold;" class="active nav-header {{ $item['class'] ?? '' }} ">

    {{ is_string($item) ? $item : $item['header'] }}

</li>
