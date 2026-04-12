<div>
    <section class="py-10">
        <div class="container mx-auto px-6">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-slate-100">{{ $project ? 'Edit Project' : 'Create Project' }}</h2>
                <a wire:navigate href="{{ route('admin.projects.index') }}"
                    class="rounded border border-slate-600 px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Back to
                    Manager</a>
            </div>

            @php
                $imageUrls = [];

                foreach ($existingImages as $path) {
                    $imageUrls[] = asset('storage/' . $path);
                }

                foreach ($images as $file) {
                    try {
                        $imageUrls[] = $file->temporaryUrl();
                    } catch (\Throwable $e) {
                        // Ignore non-previewable temporary uploads.
                    }
                }
            @endphp

            <div x-data="{
                open: false,
                index: 0,
                images: @js($imageUrls),
                show(i) {
                    if (!this.images.length) return;
                    this.index = i;
                    this.open = true;
                },
                next() {
                    if (!this.images.length) return;
                    this.index = (this.index + 1) % this.images.length;
                },
                prev() {
                    if (!this.images.length) return;
                    this.index = (this.index - 1 + this.images.length) % this.images.length;
                }
            }" class="w-full max-w-3xl mx-auto">
                <form wire:submit.prevent="save" class="rounded-lg bg-slate-900 p-8 shadow-md border border-slate-700">
                    <div class="mb-4">
                        <label for="title" class="block text-slate-300 font-bold">Title</label>
                        <input wire:model="title" type="text" id="title"
                            class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100">
                        @error('title')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-slate-300 font-bold">Description</label>
                        <textarea wire:model="description" id="description" rows="6"
                            class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100"></textarea>
                        @error('description')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6 rounded border border-slate-700 bg-slate-950/40 p-4">
                        <p class="mb-3 text-slate-200 font-semibold">Images</p>
                        <label for="images" class="block text-slate-300 font-bold">Upload Images</label>
                        <input wire:model="images" type="file" id="images" accept="image/*"
                            class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-200"
                            multiple>
                        @error('images')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        @error('images.*')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror

                        @if (count($existingImages) > 0)
                            <div class="mt-4">
                                <p class="mb-2 text-sm font-semibold text-slate-300">Existing Images</p>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    @foreach ($existingImages as $index => $image)
                                        <div class="rounded border border-slate-700 bg-slate-900 p-2">
                                            <button type="button" x-on:click="show({{ $index }})"
                                                class="block w-full">
                                                <img src="{{ asset('storage/' . $image) }}"
                                                    class="h-32 w-full rounded object-cover">
                                            </button>
                                            <button type="button" wire:click="removeExistingImage({{ $index }})"
                                                class="mt-2 w-full rounded bg-red-600 px-2 py-1 text-xs font-semibold text-white hover:bg-red-500">
                                                Delete Image
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (count($images) > 0)
                            <div class="mt-4">
                                <p class="mb-2 text-sm font-semibold text-slate-300">New Image Uploads</p>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    @foreach ($images as $index => $image)
                                        @php
                                            $previewIndex = count($existingImages) + $index;
                                        @endphp
                                        <div class="rounded border border-slate-700 bg-slate-900 p-2">
                                            <button type="button" x-on:click="show({{ $previewIndex }})"
                                                class="block w-full">
                                                <img src="{{ $image->temporaryUrl() }}"
                                                    class="h-32 w-full rounded object-cover">
                                            </button>
                                            <button type="button" wire:click="removePendingImage({{ $index }})"
                                                class="mt-2 w-full rounded bg-slate-700 px-2 py-1 text-xs font-semibold text-slate-100 hover:bg-slate-600">
                                                Remove Selection
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-6 rounded border border-slate-700 bg-slate-950/40 p-4">
                        <p class="mb-3 text-slate-200 font-semibold">Videos</p>
                        <label for="videos" class="block text-slate-300 font-bold">Upload Videos (MP4)</label>
                        <input wire:model="videos" type="file" id="videos" accept="video/mp4"
                            class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-200"
                            multiple>
                        @error('videos')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        @error('videos.*')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror

                        @if (count($existingVideos) > 0)
                            <div class="mt-4">
                                <p class="mb-2 text-sm font-semibold text-slate-300">Existing Videos</p>
                                <div class="space-y-4">
                                    @foreach ($existingVideos as $index => $video)
                                        <div class="rounded border border-slate-700 bg-slate-900 p-3">
                                            <video controls class="h-56 w-full rounded bg-black">
                                                <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                                            </video>
                                            <button type="button"
                                                wire:click="removeExistingVideo({{ $index }})"
                                                class="mt-2 w-full rounded bg-red-600 px-2 py-1 text-xs font-semibold text-white hover:bg-red-500">
                                                Delete Video
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if (count($videos) > 0)
                            <div class="mt-4">
                                <p class="mb-2 text-sm font-semibold text-slate-300">New Video Uploads</p>
                                <div class="space-y-2">
                                    @foreach ($videos as $index => $video)
                                        <div
                                            class="flex items-center justify-between rounded border border-slate-700 bg-slate-900 px-3 py-2 text-sm text-slate-200">
                                            <span class="truncate pr-3">{{ $video->getClientOriginalName() }}</span>
                                            <button type="button" wire:click="removePendingVideo({{ $index }})"
                                                class="rounded bg-slate-700 px-2 py-1 text-xs font-semibold text-slate-100 hover:bg-slate-600">
                                                Remove Selection
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="link" class="block text-slate-300 font-bold">Project Link</label>
                        <input wire:model="link" type="url" id="link"
                            class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100">
                        @error('link')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 grid gap-4 sm:grid-cols-3">
                        <div>
                            <label class="text-slate-300 font-bold">Published At</label>
                            <input wire:model="published_at" type="datetime-local"
                                class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100">
                            @error('published_at')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <label class="mt-8 inline-flex items-center gap-2 text-slate-300 font-semibold">
                            <input wire:model="is_published" type="checkbox"> Published
                        </label>
                        <label class="mt-8 inline-flex items-center gap-2 text-slate-300 font-semibold">
                            <input wire:model="is_featured" type="checkbox"> Featured
                        </label>
                    </div>

                    <div class="flex justify-between">
                        <a wire:navigate href="{{ route('admin.projects.index') }}"
                            class="rounded bg-slate-700 px-4 py-2 text-slate-100 hover:bg-slate-600">Cancel</a>
                        <button wire:loading.class='hidden' wire:target='save' type="submit"
                            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-500">
                            {{ $project ? 'Update' : 'Create' }}
                        </button>
                        <button type="button" wire:loading wire:target='save'
                            class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-500">
                            Saving...
                        </button>
                    </div>
                </form>

                <div x-show="open" x-transition.opacity x-on:keydown.escape.window="open = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                    style="display: none;">
                    <button type="button" x-on:click="open = false"
                        class="absolute right-4 top-4 rounded bg-slate-900/90 px-3 py-1 text-lg text-white">x</button>

                    <template x-if="images.length">
                        <div class="relative w-full max-w-5xl">
                            <img :src="images[index]" alt="Project image preview"
                                class="max-h-[85vh] w-full rounded object-contain">

                            <button type="button" x-show="images.length > 1" x-on:click="prev()"
                                class="absolute left-2 top-1/2 -translate-y-1/2 rounded bg-slate-900/90 px-3 py-2 text-white">
                                Prev
                            </button>
                            <button type="button" x-show="images.length > 1" x-on:click="next()"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded bg-slate-900/90 px-3 py-2 text-white">
                                Next
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>
</div>
