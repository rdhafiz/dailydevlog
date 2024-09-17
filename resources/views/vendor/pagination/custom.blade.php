@if ($paginator->hasPages())
    <div class="flex gap-[0.25rem] justify-center items-center">
        @if ($paginator->onFirstPage())
            <button type="button" class="disabled border border-[#AED725] outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     class="acorn-icons acorn-icons-chevron-left undefined">
                    <path
                        d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>
                </svg>
            </button>
        @else
            <div class="border border-[#AED725] outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20" fill="none"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         class="acorn-icons acorn-icons-chevron-left undefined">
                        <path
                            d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>
                    </svg>
                </a>
            </div>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <button type="button" class="disabled p-3 border border-[#AED725] outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"><span>{{ $element }}</span></button>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button type="button" class="active p-3 border border-[#AED725] bg-second outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg"><span>{{ $page }}</span></button>
                    @else
                        <a href="{{ $url }}" class=" p-3 border border-[#AED725] outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <div>
                <a class="border border-[#AED725] outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20"
                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                         stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined">
                        <path
                            d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path>
                    </svg>
                </a>
            </div>
        @else
            <div class="disabled border border-[#AED725] outline-0 w-[35px] h-[35px] flex justify-center items-center rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 20 20"
                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                     stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-right undefined">
                    <path
                        d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path>
                </svg>
            </div>
        @endif
    </div>
@endif
