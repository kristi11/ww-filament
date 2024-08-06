<div>
    @if($email)
        @if($hero['waves'] == 1)
            <livewire:email-waves/>
        @endif
        <section id="cta" class="{{ $background->ctaBackgroundColor }} container mx-auto text-center py-6 mb-12">
            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">
                {{ __("Reach out") }}
            </h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <h3 class="my-4 text-3xl leading-tight pb-4">
                {{ __("Have a question? Contact us!") }}
            </h3>
            @foreach($admins as $admin)
                <livewire:secure-mailto email="{{$admin->email}}"/>
            @endforeach
        </section>
    @endif
</div>
