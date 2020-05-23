<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Form\Models\FormModel;
use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\FormBuilders\ContactFormBuilder;
use App\Services\ContactService;
use App\ViewModels\Pages\Contact\ContactPageViewModel;
use App\ViewModels\Pages\Contact\InfoLinkViewModel;
use App\ViewModels\Pages\Contact\InfoViewModel;

class ContactViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * @var ContactFormBuilder
     */
    private $formBuilder;

    public function __construct(
        ContactService $contactService,
        ContactFormBuilder $formBuilder) {

        $this->contactService = $contactService;
        $this->formBuilder = $formBuilder;
    }

    public function createNewViewModel() {
        return new ContactPageViewModel();
    }

    /**
     * @param ContactPageViewModel $pageViewModel
     * @param array $params
     * @return ContactPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $pageViewModel->formData = $this->createFormViewModelData();

        $pageViewModel->infoData = $this->getModelForInfoData();

        return $pageViewModel;
    }

    /**
     * @return FormModel
     */
    private function createFormViewModelData() {

        return $this->formBuilder->createFormViewModelByConfigurationAndEntity(route('contact.send'), __('page-contact.form.send'));

    }

    /**
     * @return InfoViewModel
     */
    private function getModelForInfoData() {
        $outcome = new InfoViewModel();

        $outcome->telephone = new InfoLinkViewModel();
        $outcome->telephone->name = __('page-contact.info-telephone');
        $outcome->telephone->url = "tel:" . config('custom.company.telephone');
        $outcome->telephone->text = config('custom.company.telephone-txt');

        $outcome->email = new InfoLinkViewModel();
        $outcome->email->name = __('page-contact.info-email');
        $outcome->email->url = "mailto:" . config('custom.company.email');
        $outcome->email->text = config('custom.company.email');

        $outcome->address = new InfoLinkViewModel();
        $outcome->address->name = __('page-contact.info-address');
        $outcome->address->url = config('custom.company.address-map-url');
        $outcome->address->text = config('custom.company.address');

        return $outcome;

    }
}
