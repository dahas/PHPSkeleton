<?php

namespace Sources;

trait Tools {
    public function filterInput($input) {
        return filter_input($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
}