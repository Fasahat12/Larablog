<x-layout :$pageTitle>    
    <div class="row row-cols-1 row-cols-lg-2">
        @forelse ($posts as $key => $post)
            <x-post-card :post='$post' />
        @empty
        <div class="col-12">
            <p class='text-center'>No Posts Found</p>
        </div>    
        @endforelse        
    </div>
    @if(!$posts->isEmpty())
    <div class='mb-5 pb-4'>
        {{ $posts->links() }}        
    </div>
    @endif
</x-layout>