<?php
namespace Zeus\Facebook\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * @see \Yish\LaravelFacebookAdsSdk\LaravelFacebookAdsSdk
 */
class ZeusFacebook extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Zeus\Facebook\ZeusFacebook::class;
    }
}
