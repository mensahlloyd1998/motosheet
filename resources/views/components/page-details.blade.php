@props(['title'=>'page title', 'description' => 'Page description goes here'])

<div class="col-auto cstm-page-info">
    <h1 class=" mt-1 mb-1 fw-bold text-capitalize">{{ $title }}</h1>
    <p class="text-muted">{!!$description !!}</p>
</div>