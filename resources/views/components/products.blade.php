<div>
    <div class="flex justify-center my-20 md:m-10 lg:m-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 w-full">
            <div id="products" class="col-span-full flex justify-between mx-auto w-full px-6 gap-8">
                <div class="col-span-1">
                    <h1 class="text-lg font-medium">
                        Our products
                    </h1>
                </div>
                <div class="col-span-1">
                    <div class="relative flex w-full max-w-xs flex-col gap-1 text-neutral-600 dark:text-neutral-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true" class="absolute left-2.5 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 dark:text-neutral-300/50">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="search" wire:model.live.debounce="keywords" class="w-full rounded-md border border-neutral-300 bg-neutral-50 py-2 pl-10 pr-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white" placeholder="Search products" aria-label="search"/>
                    </div>
                </div>
            </div>
            @forelse($this->product as $product)
                @php
                    $description = strip_tags($product->description);
                @endphp
                <article class="relative mx-4 my-4 md:mx-4 md:my-4 lg:mx-6 lg:my-6 group col-span-1 flex rounded-md max-w-sm flex-col overflow-hidden border border-neutral-300 bg-neutral-50 text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                    <a href="{{ route('productInfo', $product) }}" wire:navigate class="absolute inset-0 w-full h-full"></a>
                    <!-- Image -->
                    <div class="h-44 md:h-64 overflow-hidden">
                        {{--The first image will be the image that will be displayed on the storefront--}}
                        @if($product->image)
                            <img alt="Product image" src="{{ Storage::disk(config('filesystems.disks.STORAGE_DISK'))->url($product->image[0]) }}"/>
                        @else
                            <img alt="Product image" src="https://placehold.co/600x400?text=Add+image"/>
                        @endif
                    </div>
                    <!-- Content -->
                    <div class="flex flex-col gap-4 p-6">
                        <!-- Header -->
                        <div class="flex flex-col md:flex-row gap-4 md:gap-12 justify-between">
                            <!-- Title & Rating -->
                            <div class="flex flex-col">
                                <h3 class="text-lg lg:text-xl font-bold text-neutral-900 dark:text-white" aria-describedby="productDescription">
                                    {{ $product->name }}
                                </h3>
                                <!-- Rating -->
                                {{--                                <div class="flex items-center gap-1">--}}
                                {{--                                    <span class="sr-only">Rated 3 stars</span>--}}
                                {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-amber-500" aria-hidden="true">--}}
                                {{--                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />--}}
                                {{--                                    </svg>--}}
                                {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-amber-500" aria-hidden="true">--}}
                                {{--                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />--}}
                                {{--                                    </svg>--}}
                                {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-amber-500" aria-hidden="true">--}}
                                {{--                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />--}}
                                {{--                                    </svg>--}}
                                {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-neutral-600/50 dark:text-neutral-300/50" aria-hidden="true">--}}
                                {{--                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />--}}
                                {{--                                    </svg>--}}
                                {{--                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-neutral-600/50 dark:text-neutral-300/50" aria-hidden="true">--}}
                                {{--                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />--}}
                                {{--                                    </svg>--}}
                                {{--                                </div>--}}
                            </div>
                            <span class="text-xl"><span class="sr-only">Price</span>
                                {{ $product->price }}
                            </span>
                        </div>
                        <p id="productDescription" class="mb-2 text-pretty text-sm">
                            {{ \Illuminate\Support\Str::limit($description, 60) }}
                        </p>
                    </div>
                </article>
                @empty
                <div class="flex justify-center col-span-1 md:col-span-2 lg:col-span-3 m-10">
                    <x-icons.empty-products/>
                </div>
                <div class="flex justify-center text-gray-400 col-span-1 md:col-span-2 lg:col-span-3">
                    No products found with that name
                </div>
            @endforelse
            <div class="col-span-full mx-auto w-full px-6">
                {{ $this->product->links() }}
            </div>
        </div>
    </div>
</div>
