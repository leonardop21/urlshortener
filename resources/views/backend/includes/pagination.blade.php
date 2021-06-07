@if ($paginator['links'] > 0)
    <div class="row">
        <div class="col-12 mb-3">
            <div class="dataTables_info" id="lang-dt_info" role="status" aria-live="polite">Exibindo {{($paginator['current_page']-1)*$paginator['per_page']+1}} até {{$paginator['current_page']*$paginator['per_page']}}
        de  {{$paginator['total']}} registros</div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="lang-dt_paginate">
                <ul class="pagination">
                    {{-- <li class="paginate_button page-item previous @if ($paginator->onFirstPage()) disabled @endif" id="lang-dt_previous">
                        <a href="@if ($paginator->onFirstPage()) # @else {{ $paginator->previousPageUrl() }} @endif" aria-controls="lang-dt" data-dt-idx="0" tabindex="0" class="page-link">Anterior</a>
                    </li> --}}

                    @foreach(range(1, $paginator['last_page']) as $i)
                        @if($i >= $paginator['current_page'] - 2 && $i <= $paginator['current_page'] + 2)
                            <li class="paginate_button page-item {{ ($paginator['current_page'] == $i) ? ' active' : 'page-item' }}">
                                <a href="/painel/encurtar?page={{ $i }}" aria-controls="lang-dt" data-dt-idx="{{ $i }}" tabindex="0" class="page-link">{{ $i }}</a>
                            </li>             
                        @endif
                    @endforeach

                    <li class="paginate_button page-item next @if (!$paginator['next_page_url']) disabled @endif" id="lang-dt_next">
                        <a href="@if ($paginator['next_page_url']) {{ $paginator['next_page_url'] }} @else # @endif" aria-controls="lang-dt" data-dt-idx="3" tabindex="0" class="page-link">Próximo</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif