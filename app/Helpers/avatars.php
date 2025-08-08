<?php
namespace App\Helpers;
class Avatars
{
    protected $multiavatar;

    public function __construct()
    {
        require_once base_path('vendor/multiavatar/multiavatar-php/Multiavatar.php');
        $this->multiavatar = new \Multiavatar();
    }

    public function generateAvatar(string $seed): string
    {
        // Pass the required three arguments: seed, color, and options
        return $this->multiavatar->generate($seed, null, null);
    }
}
