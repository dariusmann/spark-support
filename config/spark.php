<?php

use App\Models\User;
use Spark\Features;

return [

    /*
    |--------------------------------------------------------------------------
    | Spark Path
    |--------------------------------------------------------------------------
    |
    | This configuration option determines the URI at which the Spark billing
    | portal is available. You are free to change this URI to a value that
    | you prefer. You shall link to this location from your application.
    |
    */

    'path' => 'billing',

    /*
    |--------------------------------------------------------------------------
    | Spark Middleware
    |--------------------------------------------------------------------------
    |
    | These are the middleware that requests to the Spark billing portal must
    | pass through before being accepted. Typically, the default list that
    | is defined below should be suitable for most Laravel applications.
    |
    */

    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    |
    | These configuration values allow you to customize the branding of the
    | billing portal, including the primary color and the logo that will
    | be displayed within the billing portal. This logo value must be
    | the absolute path to an SVG logo within the local filesystem.
    |
    */

     'brand' =>  [
         //'logo' => realpath(__DIR__.'/../public/svg/billing-logo.svg'),
         'color' => '#eb826b',
     ],

    /*
    |--------------------------------------------------------------------------
    | Proration Behavior
    |--------------------------------------------------------------------------
    |
    | This value determines if charges are prorated when making adjustments
    | to a plan such as incrementing or decrementing the quantity of the
    | plan. This also determines proration behavior if changing plans.
    |
    */

    'prorates' => true,

    /*
    |--------------------------------------------------------------------------
    | Spark Date Format
    |--------------------------------------------------------------------------
    |
    | This date format will be utilized by Spark to format dates in various
    | locations within the billing portal, such as while showing invoice
    | dates. You should customize the format based on your own locale.
    |
    */

    'date_format' => 'F j, Y',

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of Spark's features are optional. You may disable the features by
    | removing them from this array. By removing features from this array
    | you can customize your Spark experience for your own application.
    |
    */

    'features' => [
        // Features::billingAddressCollection(['required' => true]),
        // Features::mustAcceptTerms(),
        // Features::euVatCollection(['home-country' => 'BE']),
        // Features::receiptEmails(['custom-addresses' => true]),
        Features::paymentNotificationEmails(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Receipt Configuration
    |--------------------------------------------------------------------------
    |
    | The following configuration options allow you to configure the data that
    | appears in PDF receipts generated by Spark. Typically, this data will
    | include a company name as well as your company contact information.
    |
    */

    'receipt_data' => [
        'vendor' => 'Darius Mann',
        'product' => 'Cert Gym',
        'street' => 'Grzybowska 3/48',
        'location' => 'Warsaw, Poland',
        'phone' => '+48 510 220 899',
    ],

    /*
    |--------------------------------------------------------------------------
    | Spark Billable
    |--------------------------------------------------------------------------
    |
    | Below you may define billable entities supported by your Spark driven
    | application. The Stripe edition of Spark currently only supports a
    | single billable model entity (team, user, etc.) per application.
    |
    | In addition to defining your billable entity, you may also define its
    | plans and the plan's features, including a short description of it
    | as well as a "bullet point" listing of its distinctive features.
    |
    */

    'billables' => [

        'user' => [
            'model' => User::class,

            'default_interval' => 'monthly',

            'plans' => [
                [
                    'name' => 'Cert Gym Full Access',
                    'short_description' => 'Get full access to the #1 platform for AWS cloud practitioner practice exams - cancel any time.',
                    'monthly_id' => 'price_1OOOtwLqwo5ZZnZEu71F5zWD',
                    'trial_days' => 5,
                    'features' => [
                        'Over 1000 Question and Answers',
                        'Extensive explanation around Questions',
                        'Tiered Difficulty Progression',
                        'Progressive Learning Engine',
                        'Intelligent Question Delivery',
                        'Readiness Score'
                    ],
                ],
            ],
        ],
    ],
];
