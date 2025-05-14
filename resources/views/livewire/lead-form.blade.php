<div>
    <!-- Centered wave animation -->
    @if($hero['waves'] == 1)
        <livewire:email-waves/>
    @endif
    <section id="contact-form" class="container mx-auto py-12 mb-12">
        <!-- Modern heading with animated underline -->
        <div class="text-center mb-10">
            <h2 class="text-5xl font-extrabold leading-tight tracking-tight mb-2"
                style="color: color-mix(in srgb, white 97%, {{$hero->gradientDegreeFirstColor}});">
                {{ __("Get in Touch") }}
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto w-64 rounded-full animate-pulse"
                     style="background-image: linear-gradient(to right, {{$hero->gradientDegreeFirstColor}}, color-mix(in srgb, {{$hero->gradientDegreeFirstColor}} 40%, white));"></div>
            </div>
            <p class="mt-4 text-xl font-light max-w-2xl mx-auto"
               style="color: color-mix(in srgb, white 90%, {{$hero->gradientDegreeFirstColor}});">
                {{ __("We'd love to hear from you. Send us a message and we'll respond as soon as possible.") }}
            </p>


        </div>

        <!-- Notification messages -->
        @if($success)
            <div class="max-w-lg mx-auto mb-8">
                <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg shadow-md transition-all duration-500 ease-in-out transform" role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">Message sent successfully! We'll be in touch soon.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->has('form'))
            <div class="max-w-lg mx-auto mb-8">
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg shadow-md" role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ $errors->first('form') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modern floating label form with glass effect -->
        <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                <form wire:submit.prevent="submit" class="space-y-6">
                    <!-- Name field with floating label -->
                    <div class="relative">
                        <input wire:model="name" type="text" id="name"
                               class="peer w-full border-0 border-b-2 border-gray-300 bg-white px-0 py-3 placeholder:text-transparent focus:border-b-2 focus:outline-none focus:ring-0 text-gray-800"
                               placeholder="Your name"
                               style="border-color: {{$hero->gradientDegreeFirstColor}};">
                        <label for="name"
                               class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm font-medium text-gray-500 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:-top-0 peer-focus:text-sm peer-focus:font-semibold"
                               style="color: {{$hero->gradientDegreeFirstColor}};">
                            Name
                        </label>
                        @error('name') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email field with floating label -->
                    <div class="relative">
                        <input wire:model="email" type="email" id="email"
                               class="peer w-full border-0 border-b-2 border-gray-300 bg-white px-0 py-3 placeholder:text-transparent focus:border-b-2 focus:outline-none focus:ring-0 text-gray-800"
                               placeholder="Your email"
                               style="border-color: {{$hero->gradientDegreeFirstColor}};">
                        <label for="email"
                               class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm font-medium text-gray-500 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:-top-0 peer-focus:text-sm peer-focus:font-semibold"
                               style="color: {{$hero->gradientDegreeFirstColor}};">
                            Email
                        </label>
                        @error('email') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone field with floating label -->
                    <div class="relative">
                        <input wire:model="phone" type="tel" id="phone"
                               class="peer w-full border-0 border-b-2 border-gray-300 bg-white px-0 py-3 placeholder:text-transparent focus:border-b-2 focus:outline-none focus:ring-0 text-gray-800"
                               placeholder="Your phone number"
                               style="border-color: {{$hero->gradientDegreeFirstColor}};">
                        <label for="phone"
                               class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm font-medium text-gray-500 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:-top-0 peer-focus:text-sm peer-focus:font-semibold"
                               style="color: {{$hero->gradientDegreeFirstColor}};">
                            Phone (optional)
                        </label>
                        @error('phone') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Message field with floating label -->
                    <div class="relative">
                        <textarea wire:model="message" id="message" rows="4"
                                  class="peer w-full border-0 border-b-2 border-gray-300 bg-white px-0 py-3 placeholder:text-transparent focus:border-b-2 focus:outline-none focus:ring-0 text-gray-800 resize-none"
                                  placeholder="Your message"
                                  style="border-color: {{$hero->gradientDegreeFirstColor}};"></textarea>
                        <label for="message"
                               class="pointer-events-none absolute top-0 left-0 origin-left -translate-y-1/2 transform text-sm font-medium text-gray-500 opacity-75 transition-all duration-100 ease-in-out peer-placeholder-shown:top-6 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-focus:-top-0 peer-focus:text-sm peer-focus:font-semibold"
                               style="color: {{$hero->gradientDegreeFirstColor}};">
                            Message (optional)
                        </label>
                        @error('message') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit button matching other buttons -->
                    <div class="pt-4 text-center">
                        <button type="submit"
                                class="mx-auto hover:underline bg-white text-gray-800 font-bold rounded-full py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
                                style="color: {{$hero->gradientDegreeFirstColor}};">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
