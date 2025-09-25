<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SecretRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     *
     * @return bool
     */
    public function authorize()
    {
        // Assure que seul un utilisateur connecté peut faire la requête.
        return backpack_auth()->check();
    }

    /**
     * Récupère les règles de validation qui s'appliquent à la requête.
     *
     * @return array
     */
    public function rules()
    {
        // 'sometimes' signifie que la validation s'applique seulement si le champ est présent dans la requête.
        // C'est utile pour la création où le mot de passe est obligatoire.
        $passwordRule = 'sometimes|required|min:8';

        // Si nous sommes sur une opération de mise à jour (update),
        // le mot de passe devient optionnel (nullable).
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $passwordRule = 'nullable|min:8';
        }

        return [
            'project'                => 'required|min:2|max:255',
            'service'                => 'required|min:2|max:255',
            'link'                   => 'nullable|url|max:255',
            'username'               => 'required|min:2|max:255',
            'password'               => $passwordRule,
            'additional_information' => 'nullable|string',
        ];
    }

    /**
     * Prépare les données pour la validation.
     * C'est ici que la magie opère pour la mise à jour !
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Si la requête est une mise à jour (PUT/PATCH) et que le champ password est vide,
        // on le supprime complètement des données de la requête.
        // Ainsi, Laravel ne tentera pas de mettre à jour le mot de passe avec une valeur vide.
        if (($this->method() === 'PUT' || $this->method() === 'PATCH') && $this->password == null) {
            $this->request->remove('password');
        }
    }

    /**
     * Personnalise les messages d'erreur de validation (optionnel mais recommandé).
     *
     * @return array
     */
    public function messages()
    {
        return [
            'project.required' => 'Le champ "Projet" est obligatoire.',
            'service.required' => 'Le champ "Service" est obligatoire.',
            'username.required' => "Le champ \"Nom d'utilisateur\" est obligatoire.",
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'link.url' => 'Le lien doit être une URL valide (ex: https://example.com).',
        ];
    }
}
