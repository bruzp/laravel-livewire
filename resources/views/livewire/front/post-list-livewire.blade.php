{{-- Infinite Scroll by: https://patrickcurl.medium.com/laravel-infinite-scrolling-with-livewire-44d952ace141 --}}

<div class="container p-4 mx-auto">
    <h1 class="text-2xl text-gray-900">Posts</h1>

    <div class="grid grid-cols-1 gap-8 mt-4 md:grid-cols-1 lg:grid-cols-1">
        @foreach($posts as $post)
        <div class="mb-5">
            <x-card title="{{ $post['title'] }}">
                <p>{{ $post['description'] }}</p>

                <x-slot name="footer">
                    <div class="flex justify-between items-center">
                        <x-button.circle positive :label="$post['id']" />
                    </div>
                </x-slot>
            </x-card>
        </div>
        @endforeach
    </div>

    @if($hasMorePages)
    <div x-data="{
                init () {
                    let observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                @this.call('loadPosts')
                            }
                        })
                    }, {
                        root: null
                    });
                    observer.POLL_INTERVAL = 100
                    observer.observe(this.$el);
                }
            }" class="grid grid-cols-1 gap-8 mt-4 md:grid-cols-1 lg:grid-cols-1">
    </div>
    @endif
</div>