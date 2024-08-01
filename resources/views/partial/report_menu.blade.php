@if(!empty($menuLinks))
    <div x-data="{
        dropdownOpen: false
    }" class="relative">
        <button @click="dropdownOpen=true"
                class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
            Download <span class="text-xs pl-1">&#9660;</span>
        </button>
        <div x-show="dropdownOpen"
             @click.away="dropdownOpen=false"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="-translate-y-2"
             x-transition:enter-end="translate-y-0"
             class="absolute top-0 z-50 w-20 mt-12 -translate-x-1/2 left-1/2"
             x-cloak>
            <div class="flex flex-col p-1 mt-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                @foreach($menuLinks as $linkData)
                    <a href="{!! $linkData['url'] !!}" @click="menuBarOpen=false"
                       @if(isset($linkData['cssClasses']))
                           class="{!! $linkData['cssClasses'] !!}"
                       @else
                           class="relative w-full text-center cursor-pointer select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none"
                        @endif
                    ><span>{!! $linkData['label'] !!}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
