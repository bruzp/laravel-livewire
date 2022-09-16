<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">

                <x-errors />

                <form wire:submit.prevent="update" class="p-5">
                    <div class="mb-3">
                        <x-input wire:model.defer="post.title" label="Title" placeholder="title" />
                    </div>

                    <div class="mb-3">
                        <x-input wire:model.lazy="post.slug" label="Slug" placeholder="slug" />
                    </div>

                    <div class="mb-5">
                        <x-textarea wire:model.defer="post.description" label="Description" placeholder="description" />
                    </div>

                    <div class="mb-5">
                        <x-checkbox id="is-active" label="Active" wire:model.defer="post.is_active" value="1" />
                    </div>

                    <x-button type="submit" primary label="Save" />
                </form>

            </div>
        </div>
    </div>
</div>