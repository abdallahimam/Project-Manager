<?php

Blade::directive('posts', function () {
    return 'Welcome to first blade directive.';
});

Blade::directive('admin', function () {
    return Auth::user()->role_id == 1 ? true : false;
});
