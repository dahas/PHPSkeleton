<?php

namespace PHPSkeleton\App;

class ContactForm {

    public function renderForm(): void
    {
        echo '<form method="POST" action="/contact"><input type="text" name="name" placeholder="Enter name ..." /><button type="submit">Senden</button></form>';
    }
}