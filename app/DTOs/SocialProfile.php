<?php

namespace App\DTOs;

readonly class SocialProfile
{
    public function __construct(
         public string $network = '',
         public string $username = '',
         public string $url = ''
    )
    {

    }


    public function fromArray(array $data):self{

        return new self(
            $data['network'] ?? '',
            $data['username'] ?? '',
            $data['url'] ?? ''
        );
    }

}
