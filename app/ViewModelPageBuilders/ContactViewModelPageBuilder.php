<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Form\Models\FormModel;
use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\FormBuilders\ContactFormBuilder;
use App\Services\ContactService;
use App\ViewModels\Pages\Contact\ContactPageViewModel;
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

        $outcome->telephone = config('custom.company.telephone');
        $outcome->telephoneText = config('custom.company.telephone-txt');

        $outcome->email = config('custom.company.email');

        $outcome->address = config('custom.company.address');
        $outcome->addressMapUrl = config('custom.company.address-map-url');

        return $outcome;

    }
}
