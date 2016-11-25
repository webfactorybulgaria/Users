# Users

This module is part of [TypiCMS](https://github.com/TypiCMS/Base), a multilingual CMS based on Laravel 5.  

## Allowing social login

### Google login
Create a Client ID and Client Secret and add this to `config/services.php`. Also add the variables to the `.env` file.

    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT', 'http://'.$_SERVER["HTTP_HOST"].'/social/handle/google')
    ],

### Auth settings
Adjust the correct settings in `config/auth.php`. 
    
    'social_users' => true, // Switches the social logins on and off
    'social_guest_register' => false, // Allows guest registration with social login
    'social_admin_emails' => env('SOCIAL_ADMIN_EMAILS', ''), // You can add more than one by separating with comma
    'social_admin_domains' => env('SOCIAL_ADMIN_DOMAINS', ''), // You can add more than one by separating with comma


