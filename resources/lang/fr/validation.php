<?php

		return[

    	'required' => 'Ce champ est requis',

    	'min' => [
        'numeric' => 'Entrez au moins :min chiffres',
        'file' => ':attribute doit être au moins :min kilo-octets.',
        'string' => 'Entrez au moins :min caractères', // instead of "The :attribute" use "This field"
        'array' => 'Choisir au moins :min éléments',
    	],

	    'max' => [
	        'numeric' => ':attribute ne doit pas dépasser :max.',
	        'file' => ':attribute ne doit pas dépasser :max kilo-octets.',
	        'string' => 'Ce champ ne doit pas dépasser :max caractères.',
	        'array' => ':attribute ne doit pas avoir plus de :max éléments.',
	    ],

	    'exists' => 'Le champ sélectionné n\'est pas valide.',

	    'unique' => 'Cela a déjà été pris.',

		'email' => 'Ce champ doit être une adresse e-mail valide.',

		'confirmed' => 'la confirmation du :attribute ne correspond pas.',

		'password_signin' => 'Mot de passe incorrect, réessayer!',

		'regex' => 'Le champ sélectionné n\'est pas valide.',

		'dimensions' => "L' :attribute doit être compris entre 500px par 500px et 3000px par 3000px", 

		'mimes' => "Le :attribute doit être un fichier de type :values.",

		];















  