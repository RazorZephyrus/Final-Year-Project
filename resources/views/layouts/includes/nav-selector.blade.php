<?php
    function is_setting($url) {
        $route = request()->url();
        foreach ($url as $key => $value) {
            if(url($value) == $route) {
                return "active open";
            }
        }

        return "";
    }

    function is_maintenance() {
        return (
            request()->route()->getName() == 'logviewer::dashboard'
        );
    }
