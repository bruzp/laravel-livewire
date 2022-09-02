<div>
    @foreach ($posts as $post)
        <div class="mb-5">
            <x-card title="{{ $post->title }}">
                <p>{{ $post->description }}</p>

                <x-slot name="footer">
                    <div class="flex justify-between items-center">
                        <x-button.circle positive :label="++$post_ctr" />
                    </div>
                </x-slot>
            </x-card>
        </div>
    @endforeach

    {{-- TO DO: infinite scroll is not yet perfect --}}

    <div x-data="{
        observe() {
            let observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        @this.call('loadMore')
                    }
                })
            }, {
                root: null
            })
    
            observer.observe(this.$el)
        }
    }" x-init="observe"></div>
</div>
