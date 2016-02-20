<?php

namespace CurrantPi;

/*
 * The interface CurrantModule is used throughout
 * the application by each content source to store
 * and return the data relevant to the module.
 */

interface CurrantModule
{
    /*
     * Returns an Object which can be
     * used by the view and the api.
     */
    public function getData();
}
