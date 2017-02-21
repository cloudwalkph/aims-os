<?php
namespace App\Models;

/**
 * @SWG\Definition(required={"client_id", "client_secret", "grant_type", "username", "password"}, type="object", @SWG\Xml(name="Token"))
 */
class Token
{
    /**
     * @SWG\Property(example="YQpRWihVgaMuzrQa6Gfdqpq5lcT6vptC4oz2L2mu")
     * @var string
     */
    protected $client_secret;
    /**
     * @SWG\Property(example="2", format="int64")
     * @var string
     */
    protected $client_id;
    /**
     * @SWG\Property(example="password")
     * @var string
     */
    protected $grant_type;
    /**
     * @SWG\Property(example="customer@cliq.com")
     * @var string
     */
    protected $username;
    /**
     * @SWG\Property(example="password")
     * @var string
     */
    protected $password;
}