@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <div class="flex-1 flex sm:hidden justify-between">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="relative inline-flex items-center px-4 py-2 text-lg font-medium text-gray-500 bg-gray-200 cursor-default rounded-l-md leading-5" aria-hidden="true">
                        &laquo; Prev
                    </span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}#movie-section" rel="prev" class="relative inline-flex items-center px-4 py-2 text-lg font-medium text-white bg-rose-900 border border-gray-300 leading-5 hover:bg-rose-700 focus:outline-none transition ease-in-out duration-150 rounded-l-md" aria-label="@lang('pagination.previous')">
                    &laquo; Prev
                </a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}#movie-section" rel="next" class="relative inline-flex items-center px-4 py-2 text-lg font-medium text-white bg-rose-900 border border-gray-300 leading-5 hover:bg-rose-700 focus:outline-none transition ease-in-out duration-150 rounded-r-md" aria-label="@lang('pagination.next')">
                    Next &raquo;
                </a>
            @else
                <span aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="relative inline-flex items-center px-4 py-2 text-lg font-medium text-gray-500 bg-gray-200 cursor-default rounded-r-md leading-5" aria-hidden="true">
                        Next &raquo;
                    </span>
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center text-2xl">
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="relative inline-flex items-center px-4 py-3 text-2xl text-white font-medium text-gray-500 bg-rose-900 border border-grey-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                &laquo;
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}#movie-section" rel="prev" class="rounded-l-md relative inline-flex items-center px-3 py-2 text-base font-medium text-white bg-transparent border border-white leading-5 hover:bg-rose-900 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="@lang('pagination.previous')">
                            &laquo;
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-3 py-2 text-base font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-3 text-2xl text-white font-medium text-gray-500 bg-rose-900 border border-grey-300 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}#movie-section" class="relative inline-flex items-center px-4 py-3 text-2xl text-white font-medium text-gray-500 bg-transparent hover:bg-rose-900 duration-150 border border-grey-300 cursor-default leading-5" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}#movie-section" rel="next" class="relative inline-flex items-center px-4 py-3 text-2xl text-white font-medium text-gray-500 bg-transparent hover:bg-rose-900 duration-150 border border-grey-300 cursor-default leading-5 rounded-r-md" aria-label="@lang('pagination.next')">
                            &raquo;
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="relative inline-flex items-center px-4 py-3 text-2xl text-white font-medium text-gray-500 bg-rose-900 border border-grey-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                &raquo;
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif