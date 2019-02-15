<p align="center">
<img src="http://unifonic.com/wp-content/uploads/2016/08/logo-1.png">
</p>


# Unifonic notification channel for Laravel 5.6+
This package makes it easy to send notifications using Unifonic with Laravel 5.5+

The Unifonic channel makes it possible to send out Laravel notifications as SMS
<p align="center">
<a href="https://packagist.org/packages/liliom/laravel-unifonic"><img src="https://poser.pugx.org/liliom/laravel-unifonic/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/liliom/laravel-unifonic"><img src="https://poser.pugx.org/liliom/laravel-unifonic/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/liliom/laravel-unifonic"><img src="https://poser.pugx.org/liliom/laravel-unifonic/license.svg" alt="License"></a>
</p>


## Installation

You can install this package via composer:

``` bash
composer require liliom/unifonic-notification-channel
```

The service provider gets loaded automatically.

### Setting up the Unifonic service

Hit to [Dashboard](https://software.unifonic.com/en/dashboard) to create a new REST app to use this channel. Within in this app, you will find the `APP SID`. Place it inside your `.env` file. To load it, add this to your `config/services.php` file:

```php
...
'unifonic' => [
    'app_id' => env('UNIFONIC_APP_SID'),
    'sender_id' => env('UNIFONIC_SENDER_ID') //optional
]
...
```

This will load the Unifonic app data from the `.env` file. Make sure to use the same keys you have used there like `UNIFONIC_APP_SID`.

## Usage

To use this package, you need to create a notification class, like `InvoicePaid` from the example below, in your Laravel application. Make sure to check out [Laravel's documentation](https://laravel.com/docs/master/notifications) for this process.

### Notification Example

```php
<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Liliom\Notifications\Messages\UnifonicMessage;

class InvoicePaid extends Notification
{
   private $message;

    /**
     * Create a new notification instance.
     *
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'unifonic',
        ];
    }

    /**
     * Get the text message representation of the notification
     *
     * @param  mixed $notifiable
     *
     * @return UnifonicMessage
     */
    public function toUnifonic($notifiable)
    {
        return (new UnifonicMessage())
            ->content($this->message);
    }
}
```

Or pass the content you want directly into the constructor
````php
public function toUnifonic($notifiable)
{
    return new UnifonicMessage('Laravel notifications are awesome!');
}
````

### Sending Notifications
There are two methods to send a notification in Laravel:
#### Method 1
Using `notify()` function on any model that uses `Notifiable` trait.
to achieve this you have to feed it with the proper column to be used as the recipient number,
as shown in the following example, this function is placed within the User model (You might want to write it in different model in your case, just make sure to `use Notifiable`)  
````php
    /**
     * Route notifications for the Unifonic channel.
     *
     * @param  \Illuminate\Notifications\Notification $notification
     *
     * @return string
     */
    public function routeNotificationForUnifonic($notification)
    {
        return $this->phone; // where phone is the column within your, let's say, users table.
    }
````

#### Method 2
Using `route()` static function on Notification class.  
````php
Notification::route('unifonic', 'xxxxx')
                 ->notify(
                    new \App\Notifications\InvoicePaid('Laravel notifications are awesome!')
                 );
                 // where xxxxx is the phone number you want to sent to,
                  i.e: 1xxxxxxx - NO NEED for _00_ or _+_ 
````





### Contributing
See the [CONTRIBUTING](CONTRIBUTING.md) guide.

### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.