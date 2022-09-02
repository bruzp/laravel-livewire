<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">

                <x-errors />

                <form wire:submit.prevent="store" class="p-5">
                    <div class="mb-3">
                        <x-input wire:model.defer="title" label="Title" placeholder="title" />
                    </div>

                    <div class="mb-5">
                        <x-textarea wire:model.defer="description" label="Description" placeholder="description" />
                    </div>

                    <x-button type="submit" primary label="Save" />
                </form>

            </div>
        </div>
    </div>
</div>
