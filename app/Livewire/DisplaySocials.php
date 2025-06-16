<?php
namespace App\Livewire;

use App\Models\Social;
use Livewire\Component;

class DisplaySocials extends Component
{
    protected ?Social $socialData = null;

    protected function getSocialData(): Social
    {
        if (!$this->socialData) {
            $this->socialData = cache()->remember('social_data', now()->addMinutes(60), function () {
                return Social::first();
            });
        }

        return $this->socialData;
    }

    public function redirectToSocialMedia(string $platform)
    {
        $socialData = $this->getSocialData();

        $urls = [
            'instagram' => 'https://www.instagram.com/',
            'facebook' => 'https://www.facebook.com/',
            'linkedin' => 'https://www.linkedin.com/in/',
            'twitter' => 'https://twitter.com/'
        ];

        if (!isset($urls[$platform]) || empty($socialData->$platform)) {
            return null;
        }

        return redirect(url($urls[$platform] . $socialData->$platform));
    }

    public function instagram()
    {
        return $this->redirectToSocialMedia('instagram');
    }

    public function facebook()
    {
        return $this->redirectToSocialMedia('facebook');
    }

    public function linkedin()
    {
        return $this->redirectToSocialMedia('linkedin');
    }

    public function twitter()
    {
        return $this->redirectToSocialMedia('twitter');
    }

    public function render()
    {
        return view('livewire.display-socials', [
            'socials' => $this->getSocialData()
        ]);
    }
}
