<?php

namespace App\Listeners;

use App\Events\BookCreated;

class BookCreatedListener
{

    /**
     * @param BookCreated $event
     * @return void
     */
    public function handle(BookCreated $event): void
    {

        /**
         * MAIL_MAILER=smtp
         * MAIL_HOST=sandbox.smtp.mailtrap.io
         * MAIL_PORT=2525
         * MAIL_USERNAME=fb8a9a7c439a9e
         * MAIL_PASSWORD=6b44cdf0cc0595
         * MAIL_ENCRYPTION=tls
         * MAIL_FROM_ADDRESS="hello@example.com"
         * MAIL_FROM_NAME="${APP_NAME}"
         */

        // TODO сюда приходят данные с формы, нужно отправить на почту сообщение после создания книги,
        // авторизация регистрация
        dd($event);
    }
}
