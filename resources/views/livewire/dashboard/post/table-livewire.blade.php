<div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">

                <div class="flex ml-2 mt-2">
                    <x-button sky href="{{ route('posts.create') }}" label="Create" />
                </div>

                <div class="flex justify-between h-16 mt-6 p-2">
                    <div class="flex">
                        <div class="mb-3">
                            <x-select label="" placeholder="Per page" :options="[10, 20, 50, 100, 500]" value="10"
                                wire:model="perPage" />
                        </div>

                        <div class="mb-3 ml-2">
                            <x-native-select label="" placeholder="Actions" :options="['Delete']" wire:model="action"
                                wire:change="$emit('executeAction')" />
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="mb-3 xl:w-96">
                            <x-input wire:model.debounce.500="search" icon="search" placeholder="Search" />
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5">
                    <table class="w-full table-auto">
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" type="checkbox" wire:model="is_checked_all"
                                            wire:change="checkAll"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('id')" type="button">#
                                        @if ($sortBy === 'id')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('username')" type="button">{{ __('Posted by') }}
                                        @if ($sortBy === 'username')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('title')" type="button">{{ __('Title') }}
                                        @if ($sortBy === 'title')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('slug')" type="button">{{ __('Slug') }}
                                        @if ($sortBy === 'slug')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('description')" type="button">{{ __('Description') }}
                                        @if ($sortBy === 'description')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('is_active')" type="button">{{ __('Status') }}
                                        @if ($sortBy === 'is_active')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4"></th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('created_at')" type="button">{{ __('Created At') }}
                                        @if ($sortBy === 'created_at')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    <button wire:click="sortBy('updated_at')" type="button">{{ __('Updated At') }}
                                        @if ($sortBy === 'updated_at')
                                        @if ($orderBy === 'ASC')
                                        <i class="fas fa-arrow-up"></i>
                                        @else
                                        <i class="fas fa-arrow-down"></i>
                                        @endif
                                        @endif
                                    </button>
                                </th>
                            </tr>
                        </thead class="border-b">
                        <tbody>
                            @forelse ($posts as $post)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="checked" value="{{ $post->id }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </td>
                                <td class="text-center px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $post->id }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $post->username }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $post->title }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ Str::limit($post->slug, 10) }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ Str::limit($post->description, 10) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <div class="flex items-center">
                                        <input type="checkbox"
                                            wire:change="updatePostStatus({{ $post->id }}, $event.target.checked)"
                                            value="1" {{ $post->is_active ? 'checked="checked"' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded
                                        focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800
                                        focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <x-button href="{{ route('posts.edit', $post->id) }}" warning label="Edit" />
                                    <x-button negative label="Delete" wire:click="confirmDestroy({{ $post->id }})" />
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $post->created_at }}
                                </td>
                                <td class="text-center text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ $post->updated_at }}
                                </td>
                            </tr class="bg-white border-b">
                            @empty
                            <tr class="text-center">
                                <td colspan="10" class="p-5"><span>No Posts Found</span></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $posts->links() }}

            </div>
        </div>
    </div>
</div>