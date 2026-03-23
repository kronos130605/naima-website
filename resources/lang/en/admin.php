<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Navigation Tabs
    |--------------------------------------------------------------------------
    */
    'nav' => [
        'dashboard' => 'Dashboard',
        'mind_maps' => 'Mind Maps',
        'videos' => 'Videos',
        'worksheets' => 'Worksheets',
        'bookings' => 'Bookings',
        'settings' => 'Settings',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Common
    |--------------------------------------------------------------------------
    */
    'common' => [
        'all' => 'All',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'actions' => 'Actions',
        'status' => 'Status',
        'published' => 'Published',
        'draft' => 'Draft',
        'total' => 'Total',
        'drafts' => 'Drafts',
        'required' => 'Required',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Videos
    |--------------------------------------------------------------------------
    */
    'videos' => [
        'title' => 'Videos',
        'new_video' => 'New Video',
        'edit_video' => 'Edit Video',
        'edit_prefix' => 'Edit:',
        'no_videos' => 'No videos found.',
        'add_first' => 'Add your first video →',
        'delete_confirm' => 'Delete this video?',
        
        // Table headers
        'table_title' => 'Title',
        'table_level' => 'Level',
        'table_topic' => 'Topic',
        'table_thumbnail' => 'Thumbnail',
        
        // Form sections
        'section_titles' => 'Titles & Descriptions',
        'section_video' => 'Video',
        'section_classification' => 'Classification',
        'section_settings' => 'Settings',
        
        // Form fields
        'title_en' => 'Title EN',
        'title_fr' => 'Title FR',
        'description_en' => 'Description EN',
        'description_fr' => 'Description FR',
        'video_url' => 'Video URL',
        'video_url_help' => 'YouTube or Vimeo URL',
        'level' => 'Level',
        'sort_order' => 'Sort Order',
        'topic_en' => 'Topic EN',
        'topic_fr' => 'Topic FR',
        'is_published' => 'Published (visible to the public)',
        
        // Placeholders
        'placeholder_title_en' => 'e.g. Passé Composé explained',
        'placeholder_title_fr' => 'e.g. Le Passé Composé expliqué',
        'placeholder_description' => 'Short description...',
        'placeholder_description_fr' => 'Description courte...',
        'placeholder_video_url' => 'https://www.youtube.com/watch?v=...',
        'placeholder_topic_en' => 'e.g. Conjugation',
        'placeholder_topic_fr' => 'e.g. Conjugaison',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Worksheets
    |--------------------------------------------------------------------------
    */
    'worksheets' => [
        'title' => 'Worksheets',
        'new_worksheet' => 'New Worksheet',
        'edit_worksheet' => 'Edit Worksheet',
        'edit_prefix' => 'Edit:',
        'no_worksheets' => 'No worksheets found.',
        'add_first' => 'Add your first worksheet →',
        'delete_confirm' => 'Delete this worksheet?',
        
        // Table headers
        'table_title' => 'Title',
        'table_level' => 'Level',
        'table_topic' => 'Topic',
        'table_preview' => 'Preview',
        
        // Form sections
        'section_titles' => 'Titles & Descriptions',
        'section_classification' => 'Classification',
        'section_files' => 'Files',
        'section_settings' => 'Settings',
        
        // Form fields
        'title_en' => 'Title EN',
        'title_fr' => 'Title FR',
        'description_en' => 'Description EN',
        'description_fr' => 'Description FR',
        'level' => 'Level',
        'sort_order' => 'Sort Order',
        'topic_en' => 'Topic EN',
        'topic_fr' => 'Topic FR',
        'preview_image' => 'Preview Image',
        'preview_image_help' => 'PNG, JPG, WEBP — max 4 MB',
        'preview_image_current' => 'Current image — upload a new one to replace it.',
        'pdf_file' => 'PDF File',
        'pdf_file_help' => 'PDF — max 10 MB',
        'pdf_file_current' => 'Current file — upload a new one to replace it.',
        'is_published' => 'Published (visible to the public)',
        
        // Placeholders
        'placeholder_title_en' => 'e.g. Passé Composé worksheet',
        'placeholder_title_fr' => 'e.g. Fiche Passé Composé',
        'placeholder_description' => 'Short description...',
        'placeholder_description_fr' => 'Description courte...',
        'placeholder_topic_en' => 'e.g. Conjugation',
        'placeholder_topic_fr' => 'e.g. Conjugaison',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Mind Maps
    |--------------------------------------------------------------------------
    */
    'mind_maps' => [
        'title' => 'Mind Maps',
        'new_mind_map' => 'New Mind Map',
        'edit_mind_map' => 'Edit Mind Map',
        'edit_prefix' => 'Edit:',
        'no_mind_maps' => 'No mind maps found.',
        'add_first' => 'Add your first mind map →',
        'delete_confirm' => 'Delete this mind map?',
        
        // Table headers
        'table_title' => 'Title',
        'table_group' => 'Group',
        'table_level' => 'Level',
        'table_topic' => 'Topic',
        'table_preview' => 'Preview',
        
        // Form sections
        'section_titles' => 'Titles & Descriptions',
        'section_classification' => 'Classification',
        'section_files' => 'Files',
        'section_settings' => 'Settings',
        
        // Form fields
        'title_en' => 'Title EN',
        'title_fr' => 'Title FR',
        'description_en' => 'Description EN',
        'description_fr' => 'Description FR',
        'group' => 'Group',
        'level' => 'Level',
        'topic_en' => 'Topic EN',
        'topic_fr' => 'Topic FR',
        'preview_image' => 'Preview Image',
        'preview_image_help' => 'PNG, JPG, WEBP — max 4 MB',
        'preview_image_current' => 'Current image — upload a new one to replace it.',
        'pdf_file' => 'PDF File',
        'pdf_file_help' => 'PDF — max 10 MB',
        'pdf_file_current' => 'Current file — upload a new one to replace it.',
        'is_published' => 'Published (visible to the public)',
        
        // Placeholders
        'placeholder_title_en' => 'e.g. Passé Composé',
        'placeholder_title_fr' => 'e.g. Le Passé Composé',
        'placeholder_description' => 'Short description...',
        'placeholder_description_fr' => 'Description courte...',
        'placeholder_level' => 'e.g. CM1',
        'placeholder_topic_en' => 'e.g. Conjugation',
        'placeholder_topic_fr' => 'e.g. Conjugaison',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Bookings
    |--------------------------------------------------------------------------
    */
    'bookings' => [
        'title' => 'Bookings',
        'no_bookings' => 'No booking requests yet.',
        
        // Stats
        'stat_total' => 'Total',
        'stat_pending' => 'Pending',
        'stat_contacted' => 'Contacted',
        'stat_confirmed' => 'Confirmed',
        
        // Filters
        'filter_all' => 'All',
        'filter_cancelled' => 'Cancelled',
        
        // Table headers
        'table_name' => 'Name',
        'table_email' => 'Email',
        'table_level' => 'Level',
        'table_lang' => 'Lang',
        'table_status' => 'Status',
        'table_date' => 'Date',
        'table_actions' => 'Actions',
        
        // Status labels
        'status_pending' => 'Pending',
        'status_contacted' => 'Contacted',
        'status_confirmed' => 'Confirmed',
        'status_cancelled' => 'Cancelled',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Dashboard
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title' => 'Dashboard',
        'welcome' => 'Welcome back! Manage your site content from here.',
        'content' => 'Content',
        'quick_links' => 'Quick Links',
        
        // Content cards
        'mind_maps_desc' => 'Add, edit and publish mind maps & study guides.',
        'videos_desc' => 'Add and publish YouTube lesson videos by level.',
        'worksheets_desc' => 'Upload and publish printable PDF exercise sheets.',
        'bookings_desc' => 'View and manage free assessment requests.',
        
        // Quick links
        'view_site' => 'View site',
        'public_mind_maps' => 'Public mind maps page',
        'public_videos' => 'Public videos page',
        'public_worksheets' => 'Public worksheets page',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel - Settings
    |--------------------------------------------------------------------------
    */
    'settings' => [
        'title' => 'Settings',
        
        // Success messages
        'profile_updated' => 'Profile updated successfully.',
        'password_updated' => 'Password updated successfully.',
        
        // Profile section
        'profile_title' => 'Profile Information',
        'profile_desc' => 'Update your account name and email address.',
        'label_name' => 'Name',
        'label_email' => 'Email',
        'save_profile' => 'Save Profile',
        
        // Password section
        'password_title' => 'Update Password',
        'password_desc' => 'Use a long, random password to keep your account secure.',
        'label_current_password' => 'Current Password',
        'label_new_password' => 'New Password',
        'label_confirm_password' => 'Confirm Password',
        'update_password' => 'Update Password',
    ],
];
