<?php

namespace App\Livewire;

use App\Actions\Socials\RedirectToSocialMedia;
use App\Models\Social;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class DisplaySocials extends Component
{
    protected ?Social $socialData = null;

    protected function getSocialData(): Social
    {
        if (! $this->socialData) {
            $this->socialData = cache()->remember('social_data', now()->addMinutes(60), function () {
                return Social::first();
            });
        }

        return $this->socialData;
    }

    public function redirectToSocialMedia(string $platform, RedirectToSocialMedia $redirectAction): ?RedirectResponse
    {
        $url = $redirectAction->execute($platform);

        if (! $url) {
            return null;
        }

        return redirect()->away($url);
    }

    public function instagram()
    {
        return $this->redirectToSocialMedia('instagram', app(RedirectToSocialMedia::class));
    }

    public function facebook()
    {
        return $this->redirectToSocialMedia('facebook', app(RedirectToSocialMedia::class));
    }

    public function linkedin()
    {
        return $this->redirectToSocialMedia('linkedin', app(RedirectToSocialMedia::class));
    }

    public function twitter()
    {
        return $this->redirectToSocialMedia('twitter', app(RedirectToSocialMedia::class));
    }

    public function render()
    {
        return view('livewire.display-socials', [
            'socials' => $this->getSocialData(),
        ]);
    }
}
