@foreach (config('menu') as $group_items)
<div class="@if($loop->index > 0) mt-6 pt-6 @endif px-2 space-y-1">
    @foreach ($group_items as $key => $item)
    @if(!empty($item['name']))
        @if(!empty($item['route']))
            @if(Helpers::isRouteValid($item['route']))
            <a href="{{ route($item['route']) }}" class="@if (request()->route()->named($item['route_active'])) bg-cyan-800 text-white @else text-cyan-100 hover:text-white hover:bg-cyan-600 @endif group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md" aria-current="page">
                @if(!empty($item['icon']))
                {!! $item['icon'] !!}
                @endif
                <span class="flex-1">{{ __($item['name']) }}</span>
            </a>
            @endif
        @elseif(!empty($item['items']))
            @php
                $route_list = array_column($item['items'], 'route_active');
                $show = false;
                foreach($route_list as $route) {
                    $show = request()->route()->named($route);
                    if($show) {
                        break;
                    }
                }
                $show = $show ? 'true' : 'false';
            @endphp
            <div x-data="{ show: {{ $show }} }" class="space-y-1 {{$show? 'text-cyan-100' : 'hover:text-white' }}" aria-label="sub-menu-{{ $item['name'] }}">
                <button type="button" class="group w-full flex items-center pl-2 pr-1 py-2 text-left text-sm font-medium rounded-md focus:outline-none text-cyan-100 hover:text-white hover:bg-cyan-600" aria-controls="sub-menu-{{ $item['name'] }}" x-on:click="show = !show">
                    @if(!empty($item['icon']))
                    {!! $item['icon'] !!}
                    @endif
                    <span class="flex-1">{{ __($item['name']) }}</span>
                    <svg class="ml-3 flex-shrink-0 w-5 h-5 transform group-hover:text-white transition-colors ease-in-out duration-150" viewBox="0 0 20 20" :class="{ 'text-gray-100 rotate-90': show, 'hover:text-white': !(show) }"><path d="M6 6L14 10L6 14V6Z" fill="currentColor"></path></svg>
                </button>
                <div x-show="show" style="display: none;" class="space-y-1"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95">
                    @foreach ($item['items'] as $subitem)
                    <a href="{{ route($subitem['route']) }}" class="@if(request()->route()->named($subitem['route_active'])) bg-cyan-800 text-white @else text-cyan-100 hover:text-white hover:bg-cyan-600 @endif group w-full flex items-center pl-11 pr-2 py-2 text-sm font-medium rounded-md">{{ __($subitem['name']) }}</a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
    @endforeach
</div>
@endforeach
