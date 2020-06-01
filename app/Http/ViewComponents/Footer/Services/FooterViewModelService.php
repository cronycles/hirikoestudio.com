<?php

namespace App\Http\ViewComponents\Footer\Services;

use App\Http\ViewComponents\Footer\Models\ContactInfoViewModel;
use App\Http\ViewComponents\Footer\Models\ContactsViewModel;
use App\Http\ViewComponents\Footer\Models\SubFooterViewModel;
use App\Http\ViewComponents\Footer\Models\FooterSocialLinkViewModel;
use App\Http\ViewComponents\Footer\Models\FooterViewModel;
use App\Http\ViewComponents\Footer\Models\LogoViewModel;

class FooterViewModelService {

    public function __construct() {
    }

    public function getModel() {
        $outcome = new FooterViewModel();

        $outcome->logo = $this->createLogoViewModel();
        $outcome->contacts = $this->createContactsViewModel();
        $outcome->socials = $this->createSocialLinks();
        $outcome->sub = $this->createSubFooterViewModel();

        return $outcome;
    }

    /**
     * @return LogoViewModel
     */
    private function createLogoViewModel() {
        $outcome = new LogoViewModel();
        $outcome->imageUrl = config('custom.images.static.logoBlack');
        $outcome->htmlTitle = config('custom.company.name');
        $outcome->slogan = __('footer.logo-slogan');
        return $outcome;

    }

    /**
     * @return ContactsViewModel
     */
    private function createContactsViewModel() {
        $outcome = new ContactsViewModel();
        $outcome->address = new ContactInfoViewModel();
        $outcome->address->title = __('footer.info-address') . ': ' . config('custom.company.altAddress');
        $outcome->address->text = config('custom.company.altAddress');
        $outcome->address->url = config('custom.company.address-map-url');

        $outcome->telephone = new ContactInfoViewModel();
        $outcome->telephone->title = __('footer.info-telephone') . ': ' . config('custom.company.telephone-txt');
        $outcome->telephone->text = config('custom.company.telephone-txt');
        $outcome->telephone->url = "tel:" . config('custom.company.telephone');

        $outcome->email = new ContactInfoViewModel();
        $outcome->email->title = __('footer.info-email') . ': ' . config('custom.company.email');
        $outcome->email->text = config('custom.company.email');
        $outcome->email->url = "mailto:" . config('custom.company.email');

        return $outcome;

    }

    /**
     * @return FooterSocialLinkViewModel[]
     */
    private function createSocialLinks() {
        $outcome = [
            new FooterSocialLinkViewModel(
                config('custom.company.socials.instagram.linkUrl'),
                config('custom.company.socials.instagram.linkText'),
                config('custom.company.socials.instagram.iconClass'))
        ];
        return $outcome;
    }

    /**
     * @return SubFooterViewModel
     */
    private function createSubFooterViewModel() {
        $outcome = new SubFooterViewModel();
        $outcome->cookiePolicyText = __('footer.cookie-policy-text');
        $outcome->cookiePolicyUrl = route('cookie');
        $outcome->privacyPolicyText = __('footer.privacy-policy-text');
        $outcome->privacyPolicyUrl = route('privacy');
        $outcome->copyrightText = "Copiright © ". now()->year ." " .config('custom.company.crointhemorning.name');
        $outcome->copyrightUrl = config('custom.company.crointhemorning.url');
        $outcome->vatNumber = __('footer.copyright.vat-number') . " " .config('custom.company.vat-number');
        $outcome->allRightReserved = __('footer.rights-reserved');
        $outcome->appVersion = "v" . config('app.version');

        return $outcome;

    }

}
