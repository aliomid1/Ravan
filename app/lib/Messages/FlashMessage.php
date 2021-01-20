<?php namespace App\lib\Messages;

/**
 * Class FlashMessage
 * @package App\Lib\Session
 */
class FlashMessage
{
    /**
     * @param bool $condition
     * @param string $message
     */
    public static function set(string $condition = null, string $message = null): void
    {
        request()->session()->flash('toast', ['message' => $message, 'type' => $condition ]);
    }
}