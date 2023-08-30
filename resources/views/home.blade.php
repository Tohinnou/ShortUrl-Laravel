@extends('base')

@section('content')
<div class="container mt-5">
    <div class="row">
        <section class="col-lg-6 col-md-12 mx-auto" id="linksSection">
            <div class="list-group">
                @foreach ($links as $link)
                    <div class="list-group-item list-group-item-action" id="link_{{$link->hash}}" data-hash={{$link->hash}}>
                        
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">{{ $link->domain }}</h5>
                            <small>{{ $link->created_at}}</small>
                        </div>

                        <p class=" float-start mb-1 fw-bold">
                            {{ $link->statistics->first()?->clicks }}
                            <i class="far fa-chart-bar"></i> 
                        </p>

                        <div class="d-flex justify-content-between w-100">
                            <a class="text-danger fw-700" id="anchor_{{ $link->hash}}" href="{{ $link->shortUrl}}" target="_blank">  {{ $link->shortUrl }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <div class="mt-2 row">
        <div class="col-lg-4 col-md-12 justify-content-between mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex w-100 justify-content-between" id="actions">
                        <button class="btn btn-sm btn-primary" id="btnCopy" disabled>Copy</button>
                        <button class="btn btn-sm btn-success" id="btnStatistic" disabled>Statistic</button>
                        <button class="btn btn-sm btn-danger" id="btnDelete" disabled>Delete</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="bottom-0 end-0 p-3 position-fixed">
        <div class="toast" id="copyToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="ne-auto">Shorten Url</strong>
                <button type="button" class="btn-close" data-bs-dismiss="close" aria-label="close"></button>
            </div>

            <div class="toast-body">
                Le lien a été copié ! 
            </div>
        </div>
    </div>
</div>
@endsection

