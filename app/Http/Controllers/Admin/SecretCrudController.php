<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SecretRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;

/**
 * Class SecretCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SecretCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected function setupShowOperation()
    {
        CRUD::column('project')->label('Projet');
        CRUD::column('service')->label('Service');
        CRUD::addColumn([
            'name' => 'link',
            'label' => 'Lien',
            'type' => 'custom_html',
            'value' => function ($entry) {
                $id = 'link-' . $entry->id;
                $val = e($entry->link);
                $tooltipId = 'tooltip-link-' . $entry->id;
                return '<span id="' . $id . '">' . $val . '</span> '
                    . '<a href="#" onclick="navigator.clipboard.writeText(\'' . $val . '\'); var tt=document.getElementById(\'' . $tooltipId . '\'); tt.style.display=\'inline\'; setTimeout(function(){tt.style.display=\'none\';},1200); return false;" title="Copier"><i class="la la-copy"></i></a>'
                    . '<span id="' . $tooltipId . '" class="tooltip-copy">Copié !</span>';
            },
        ]);
        CRUD::addColumn([
            'name' => 'username',
            'label' => "Nom d'utilisateur",
            'type' => 'custom_html',
            'value' => function ($entry) {
                $id = 'username-' . $entry->id;
                $val = e($entry->username);
                $tooltipId = 'tooltip-username-' . $entry->id;
                return '<span id="' . $id . '">' . $val . '</span> '
                    . '<a href="#" onclick="navigator.clipboard.writeText(\'' . $val . '\'); var tt=document.getElementById(\'' . $tooltipId . '\'); tt.style.display=\'inline\'; setTimeout(function(){tt.style.display=\'none\';},1200); return false;" title="Copier"><i class="la la-copy"></i></a>'
                    . '<span id="' . $tooltipId . '" class="tooltip-copy">Copié !</span>';
            },
        ]);
        CRUD::addColumn([
            'name' => 'password',
            'label' => 'Mot de passe',
            'type' => 'custom_html',
            'value' => function ($entry) {
                $id = 'pw-' . $entry->id;
                $pw = e($entry->password);
                $tooltipId = 'tooltip-' . $entry->id;
                return '<span id="' . $id . '" style="letter-spacing:2px;">••••••••</span> '
                    . '<a href="#" onclick="navigator.clipboard.writeText(\'' . $pw . '\'); var tt=document.getElementById(\'' . $tooltipId . '\'); tt.style.display=\'inline\'; setTimeout(function(){tt.style.display=\'none\';},1200); return false;" title="Copier"><i class="la la-copy"></i></a>'
                    . '<span id="' . $tooltipId . '" class="tooltip-copy">Copié !</span>';
            },
        ]);
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => 'Actif',
            'type' => 'custom_html',
            'value' => function ($entry) {
                return $entry->is_active ? 'Oui' : 'Non';
            },
        ]);
        CRUD::column('additional_information')->label('Info. complémentaires');
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\Domains\Secret\Models\Secret::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/secret');
        CRUD::setEntityNameStrings('secret', 'secrets');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('project')->label('Projet');
        CRUD::column('service')->label('Service');
        CRUD::addColumn([
            'name' => 'link',
            'label' => 'Lien',
            'type' => 'custom_html',
            'value' => function ($entry) {
                $id = 'link-show-' . $entry->id;
                $val = e($entry->link);
                $tooltipId = 'tooltip-link-show-' . $entry->id;
                return '<span id="' . $id . '">' . $val . '</span> '
                    . '<a href="#" onclick="navigator.clipboard.writeText(\'' . $val . '\'); var tt=document.getElementById(\'' . $tooltipId . '\'); tt.style.display=\'inline\'; setTimeout(function(){tt.style.display=\'none\';},1200); return false;" title="Copier"><i class="la la-copy"></i></a>'
                    . '<span id="' . $tooltipId . '" class="tooltip-copy">Copié !</span>';
            },
        ]);
        CRUD::addColumn([
            'name' => 'username',
            'label' => "Nom d'utilisateur",
            'type' => 'custom_html',
            'value' => function ($entry) {
                $id = 'username-show-' . $entry->id;
                $val = e($entry->username);
                $tooltipId = 'tooltip-username-show-' . $entry->id;
                return '<span id="' . $id . '">' . $val . '</span> '
                    . '<a href="#" onclick="navigator.clipboard.writeText(\'' . $val . '\'); var tt=document.getElementById(\'' . $tooltipId . '\'); tt.style.display=\'inline\'; setTimeout(function(){tt.style.display=\'none\';},1200); return false;" title="Copier"><i class="la la-copy"></i></a>'
                    . '<span id="' . $tooltipId . '" class="tooltip-copy">Copié !</span>';
            },
        ]);
        CRUD::addColumn([
            'name' => 'password',
            'label' => 'Mot de passe',
            'type' => 'custom_html',
            'value' => function ($entry) {
                $id = 'pw-show-' . $entry->id;
                $pw = e($entry->password);
                $tooltipId = 'tooltip-show-' . $entry->id;
                return '<span id="' . $id . '" style="letter-spacing:2px;">••••••••</span> '
                    . '<a href="#" onclick="navigator.clipboard.writeText(\'' . $pw . '\'); var tt=document.getElementById(\'' . $tooltipId . '\'); tt.style.display=\'inline\'; setTimeout(function(){tt.style.display=\'none\';},1200); return false;" title="Copier"><i class="la la-copy"></i></a>'
                    . '<span id="' . $tooltipId . '" class="tooltip-copy">Copié !</span>';
            },
        ]);
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => 'Actif',
            'type' => 'custom_html',
            'value' => function ($entry) {
                return $entry->is_active ? 'Oui' : 'Non';
            },
        ]);
        CRUD::column('additional_information')->label('Info. complémentaires');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $user = backpack_user();

        CRUD::setValidation(SecretRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field('password')->type('password');
        CRUD::field('project')->label('projet');
        CRUD::field('service')->label('service');
        CRUD::field('link')->label('lien');
        CRUD::field('username')->label("Nom d'utilisateur");
        CRUD::field('password')->label('Mot de passe');
        CRUD::field('is_active')->label('Actif');
        CRUD::field('additional_information')->label('Info. complémentaires');
        CRUD::field('created_by')->type('hidden')->value($user->id);
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
