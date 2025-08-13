@php
$records_per_page_list = [ "10","20","50","All" ];
$records_per_page_string = implode(",", array_map(function($item) {
    return "&quot;" . $item . "&quot;";
},$records_per_page_list));
@endphp
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div class="">
            <div class="flex items-center text-sm text-gray-700 leading-5">
                {!! __('Showing') !!}
                <div class="space-y-1 mx-3" x-data="Components.customSelect({ open: false, value: 0, selected: 0 })" x-init="init()">
                    <div class="relative">
                        <span class="inline-block w-full rounded-md shadow-sm">
                            <button x-ref="button" @keydown.arrow-up.stop.prevent="onButtonClick()" @keydown.arrow-down.stop.prevent="onButtonClick()" @click="onButtonClick()" type="button" aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label" class="cursor-default relative w-full rounded-md border border-gray-300 bg-white pl-3 pr-10 py-2 text-left focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150 sm:text-sm sm:leading-5" aria-expanded="true">
                                <div class="flex items-center space-x-3">
                                    <span x-text="[{!! $records_per_page_string !!}][value]" class="block truncate">{{ $records_per_page_list[0] }}</span>
                                </div>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </button>
                        </span>

                        <div x-show="open" style="display: none;" @click.away="open = false" x-description="Select popover, show/hide based on select state."
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="absolute mt-1 w-full rounded-md bg-white shadow-lg">
                            <ul @keydown.enter.stop.prevent="onOptionSelect()" @keydown.space.stop.prevent="onOptionSelect()" @keydown.escape="onEscape()" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()" x-ref="listbox" tabindex="-1" role="listbox" aria-labelledby="listbox-label" :aria-activedescendant="activeDescendant" class="max-h-56 rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5" x-max="1" aria-activedescendant="">
                                @foreach ($records_per_page_list as $records_per_page)
                                <li x-description="Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation." x-state:on="Highlighted" x-state:off="Not Highlighted" id="listbox-item-{{$loop->index}}" role="option" @click="choose({{$loop->index}})" @mouseenter="selected = {{$loop->index}}" @mouseleave="selected = null" :class="{ 'text-white bg-indigo-600': selected === {{$loop->index}}, 'text-gray-900': !(selected === {{$loop->index}}) }" class="cursor-default select-none relative py-2 pl-3 pr-9 text-gray-900">
                                    <div class="flex items-center space-x-3">
                                        <span x-state:on="Selected" x-state:off="Not Selected" :class="{ 'font-semibold': value === {{$loop->index}}, 'font-normal': !(value === {{$loop->index}}) }" class="block truncate font-normal"> {{ _($records_per_page) }} </span>
                                    </div>

                                    <span x-description="Checkmark, only display for selected option." x-state:on="Highlighted" x-state:off="Not Highlighted" x-show="value === {{$loop->index}}" :class="{ 'text-white': selected === {{$loop->index}}, 'text-brand': !(selected === {{$loop->index}}) }" class="absolute inset-y-0 right-0 flex items-center pr-4 text-brand" style="display: none;">
                                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {!! __('records per page') !!}
            </div>
        </div>

        <div class="flex items-center">
            <label for="search" class="block text-sm leading-5 font-semibold text-gray-700">Search</label>
            <div class="mx-2 relative rounded-md shadow-sm">
                <input id="search" class="relative w-full rounded-md border border-gray-300 bg-white pl-3 pr-10 py-2 text-left focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="">
            </div>
            <div>
                <span class="rounded-md shadow-sm">
                    <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-semibold text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150" id="options-menu" aria-haspopup="true" aria-expanded="true">
                        Search
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            </div>
        </div>
    </div>
</nav>
