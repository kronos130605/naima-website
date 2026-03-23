<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Navigation Tabs
    |--------------------------------------------------------------------------
    */
    'nav' => [
        'dashboard' => 'Tableau de bord',
        'mind_maps' => 'Cartes mentales',
        'videos' => 'Vidéos',
        'worksheets' => 'Fiches de travail',
        'bookings' => 'Réservations',
        'settings' => 'Paramètres',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Common
    |--------------------------------------------------------------------------
    */
    'common' => [
        'all' => 'Tous',
        'edit' => 'Modifier',
        'delete' => 'Supprimer',
        'save' => 'Enregistrer',
        'cancel' => 'Annuler',
        'actions' => 'Actions',
        'status' => 'Statut',
        'published' => 'Publié',
        'draft' => 'Brouillon',
        'total' => 'Total',
        'drafts' => 'Brouillons',
        'required' => 'Requis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Videos
    |--------------------------------------------------------------------------
    */
    'videos' => [
        'title' => 'Vidéos',
        'new_video' => 'Nouvelle vidéo',
        'edit_video' => 'Modifier la vidéo',
        'edit_prefix' => 'Modifier :',
        'no_videos' => 'Aucune vidéo trouvée.',
        'add_first' => 'Ajoutez votre première vidéo →',
        'delete_confirm' => 'Supprimer cette vidéo ?',
        
        // Table headers
        'table_title' => 'Titre',
        'table_level' => 'Niveau',
        'table_topic' => 'Sujet',
        'table_thumbnail' => 'Miniature',
        
        // Form sections
        'section_titles' => 'Titres et descriptions',
        'section_video' => 'Vidéo',
        'section_classification' => 'Classification',
        'section_settings' => 'Paramètres',
        
        // Form fields
        'title_en' => 'Titre EN',
        'title_fr' => 'Titre FR',
        'description_en' => 'Description EN',
        'description_fr' => 'Description FR',
        'video_url' => 'URL de la vidéo',
        'video_url_help' => 'URL YouTube ou Vimeo',
        'level' => 'Niveau',
        'sort_order' => 'Ordre de tri',
        'topic_en' => 'Sujet EN',
        'topic_fr' => 'Sujet FR',
        'is_published' => 'Publié (visible au public)',
        
        // Placeholders
        'placeholder_title_en' => 'ex. Passé Composé explained',
        'placeholder_title_fr' => 'ex. Le Passé Composé expliqué',
        'placeholder_description' => 'Courte description...',
        'placeholder_description_fr' => 'Description courte...',
        'placeholder_video_url' => 'https://www.youtube.com/watch?v=...',
        'placeholder_topic_en' => 'ex. Conjugation',
        'placeholder_topic_fr' => 'ex. Conjugaison',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Worksheets
    |--------------------------------------------------------------------------
    */
    'worksheets' => [
        'title' => 'Fiches de travail',
        'new_worksheet' => 'Nouvelle fiche',
        'edit_worksheet' => 'Modifier la fiche',
        'edit_prefix' => 'Modifier :',
        'no_worksheets' => 'Aucune fiche trouvée.',
        'add_first' => 'Ajoutez votre première fiche →',
        'delete_confirm' => 'Supprimer cette fiche ?',
        
        // Table headers
        'table_title' => 'Titre',
        'table_level' => 'Niveau',
        'table_topic' => 'Sujet',
        'table_preview' => 'Aperçu',
        
        // Form sections
        'section_titles' => 'Titres et descriptions',
        'section_classification' => 'Classification',
        'section_files' => 'Fichiers',
        'section_settings' => 'Paramètres',
        
        // Form fields
        'title_en' => 'Titre EN',
        'title_fr' => 'Titre FR',
        'description_en' => 'Description EN',
        'description_fr' => 'Description FR',
        'level' => 'Niveau',
        'sort_order' => 'Ordre de tri',
        'topic_en' => 'Sujet EN',
        'topic_fr' => 'Sujet FR',
        'preview_image' => 'Image d\'aperçu',
        'preview_image_help' => 'PNG, JPG, WEBP — max 4 Mo',
        'preview_image_current' => 'Image actuelle — téléchargez-en une nouvelle pour la remplacer.',
        'pdf_file' => 'Fichier PDF',
        'pdf_file_help' => 'PDF — max 10 Mo',
        'pdf_file_current' => 'Fichier actuel — téléchargez-en un nouveau pour le remplacer.',
        'is_published' => 'Publié (visible au public)',
        
        // Placeholders
        'placeholder_title_en' => 'ex. Passé Composé worksheet',
        'placeholder_title_fr' => 'ex. Fiche Passé Composé',
        'placeholder_description' => 'Courte description...',
        'placeholder_description_fr' => 'Description courte...',
        'placeholder_topic_en' => 'ex. Conjugation',
        'placeholder_topic_fr' => 'ex. Conjugaison',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Mind Maps
    |--------------------------------------------------------------------------
    */
    'mind_maps' => [
        'title' => 'Cartes mentales',
        'new_mind_map' => 'Nouvelle carte',
        'edit_mind_map' => 'Modifier la carte',
        'edit_prefix' => 'Modifier :',
        'no_mind_maps' => 'Aucune carte mentale trouvée.',
        'add_first' => 'Ajoutez votre première carte →',
        'delete_confirm' => 'Supprimer cette carte ?',
        
        // Table headers
        'table_title' => 'Titre',
        'table_group' => 'Groupe',
        'table_level' => 'Niveau',
        'table_topic' => 'Sujet',
        'table_preview' => 'Aperçu',
        
        // Form sections
        'section_titles' => 'Titres et descriptions',
        'section_classification' => 'Classification',
        'section_files' => 'Fichiers',
        'section_settings' => 'Paramètres',
        
        // Form fields
        'title_en' => 'Titre EN',
        'title_fr' => 'Titre FR',
        'description_en' => 'Description EN',
        'description_fr' => 'Description FR',
        'group' => 'Groupe',
        'level' => 'Niveau',
        'topic_en' => 'Sujet EN',
        'topic_fr' => 'Sujet FR',
        'preview_image' => 'Image d\'aperçu',
        'preview_image_help' => 'PNG, JPG, WEBP — max 4 Mo',
        'preview_image_current' => 'Image actuelle — téléchargez-en une nouvelle pour la remplacer.',
        'pdf_file' => 'Fichier PDF',
        'pdf_file_help' => 'PDF — max 10 Mo',
        'pdf_file_current' => 'Fichier actuel — téléchargez-en un nouveau pour le remplacer.',
        'is_published' => 'Publié (visible au public)',
        
        // Placeholders
        'placeholder_title_en' => 'ex. Passé Composé',
        'placeholder_title_fr' => 'ex. Le Passé Composé',
        'placeholder_description' => 'Courte description...',
        'placeholder_description_fr' => 'Description courte...',
        'placeholder_level' => 'ex. CM1',
        'placeholder_topic_en' => 'ex. Conjugation',
        'placeholder_topic_fr' => 'ex. Conjugaison',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Bookings
    |--------------------------------------------------------------------------
    */
    'bookings' => [
        'title' => 'Réservations',
        'no_bookings' => 'Aucune demande de réservation pour le moment.',
        
        // Stats
        'stat_total' => 'Total',
        'stat_pending' => 'En attente',
        'stat_contacted' => 'Contacté',
        'stat_confirmed' => 'Confirmé',
        
        // Filters
        'filter_all' => 'Tous',
        'filter_cancelled' => 'Annulé',
        
        // Table headers
        'table_name' => 'Nom',
        'table_email' => 'Email',
        'table_level' => 'Niveau',
        'table_lang' => 'Langue',
        'table_status' => 'Statut',
        'table_date' => 'Date',
        'table_actions' => 'Actions',
        
        // Status labels
        'status_pending' => 'En attente',
        'status_contacted' => 'Contacté',
        'status_confirmed' => 'Confirmé',
        'status_cancelled' => 'Annulé',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Dashboard
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title' => 'Tableau de bord',
        'welcome' => 'Bon retour ! Gérez le contenu de votre site depuis ici.',
        'content' => 'Contenu',
        'quick_links' => 'Liens rapides',
        
        // Content cards
        'mind_maps_desc' => 'Ajoutez, modifiez et publiez des cartes mentales et guides d\'étude.',
        'videos_desc' => 'Ajoutez et publiez des vidéos de cours YouTube par niveau.',
        'worksheets_desc' => 'Téléchargez et publiez des fiches d\'exercices PDF imprimables.',
        'bookings_desc' => 'Consultez et gérez les demandes d\'évaluation gratuite.',
        
        // Quick links
        'view_site' => 'Voir le site',
        'public_mind_maps' => 'Page publique des cartes mentales',
        'public_videos' => 'Page publique des vidéos',
        'public_worksheets' => 'Page publique des fiches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Settings
    |--------------------------------------------------------------------------
    */
    'settings' => [
        'title' => 'Paramètres',
        
        // Success messages
        'profile_updated' => 'Profil mis à jour avec succès.',
        'password_updated' => 'Mot de passe mis à jour avec succès.',
        
        // Profile section
        'profile_title' => 'Informations du profil',
        'profile_desc' => 'Mettez à jour le nom et l\'adresse e-mail de votre compte.',
        'label_name' => 'Nom',
        'label_email' => 'Email',
        'save_profile' => 'Enregistrer le profil',
        
        // Password section
        'password_title' => 'Mettre à jour le mot de passe',
        'password_desc' => 'Utilisez un mot de passe long et aléatoire pour sécuriser votre compte.',
        'label_current_password' => 'Mot de passe actuel',
        'label_new_password' => 'Nouveau mot de passe',
        'label_confirm_password' => 'Confirmer le mot de passe',
        'update_password' => 'Mettre à jour le mot de passe',
    ],
];
