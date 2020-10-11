<?php

use Symfony\Component\HttpClient\HttpClient;

class OgQuery {
    private $HttpClient;
    private $endpoint;
    private $metaTagsToReturn;
    private $responseContent;

    /**
     * OgQuery constructor.
     * @param bool $endpoint FQDM endpoint.
     */
    public function __construct()
    {
        $client = HttpClient::create();
        $this->setHttpClient($client);

        return $this;
    }

    /**
     * Set the endpoint for the request.
     * @param String $endpoint
     * @return $this
     */
    public function endpoint(String $endpoint)
    {
        $this->setEndpoint($endpoint);

        return $this;
    }

    /**
     * Execute the request and store the request content.
     * @return $this
     */
    public function execute() {
        $response = $this->HttpClient->request('GET', $this->getEndpoint());

        $this->setResponseContent($response->getContent());

        return $this;
    }

    /**
     * Set a list of meta tags to return from the
     * request.
     * @param array $tags
     */
    public function meta_tags(Array $tags = [])
    {
        if(gettype($tags) !== 'array') {
            throw new Exception('Meta tags must be an array.');
        }

        $this->setMetaTagsToReturn($tags);

        return $this;

    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getHttpClient()
    {
        return $this->HttpClient;
    }

    /**
     * @param mixed $HttpClient
     */
    public function setHttpClient($HttpClient)
    {
        $this->HttpClient = $HttpClient;
    }

    /**
     * @return mixed
     */
    public function getMetaTagsToReturn()
    {
        return $this->metaTagsToReturn;
    }

    /**
     * @param mixed $metaTagsToReturn
     */
    public function setMetaTagsToReturn($metaTagsToReturn)
    {
        $this->metaTagsToReturn = $metaTagsToReturn;
    }

    /**
     * @return mixed
     */
    public function getResponseContent()
    {
        return $this->responseContent;
    }

    /**
     * @param mixed $responseContent
     */
    public function setResponseContent($responseContent)
    {
        $this->responseContent = $responseContent;
    }

}