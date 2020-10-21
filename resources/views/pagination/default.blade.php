<div class="row mt-4">
    <div class="col-md-12">
        <div class="nav-action">
            @if ($paginator->hasPages())
                <a href="{{ $paginator->previousPageUrl() }}" class="item-nav-action m-0 mr-2">Sebelumnya</a>
                <a href="{{ $paginator->nextPageUrl() }}" class="item-nav-action m-0">Selanjutnya</a>
            @endif
        </div>
    </div>
</div>



