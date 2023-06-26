@props(['post'])
<div {{ $attributes->merge(['class' => 'col']) }}>
    <div class="card mb-3" style="overflow:hidden;height:200px;">
        <div class="row g-0">
            <div class="col-4">
            <img style="height:200px;object-fit:cover;" src="{{ asset('storage/'.$post->image) }}" class="img-fluid rounded-start w-100" alt="...">
            </div>
            <div class="col-8">
            <div class="card-body">
                <h4 class="card-title"><a href="/post/{{ $post->id }}" class="text-decoration-none text-dark">{{ Str::limit($post->title,18) }}</a></h4>
                <p class="card-text">{{ Str::limit(strip_tags($post->description),60) }}</p>
                <p class="card-text"><small class="text-muted">Last updated {{ $post->created_at->diffForHumans() }}</small></p>
            </div>
            </div>
        </div>
    </div>
</div>             
