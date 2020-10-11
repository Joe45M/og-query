<?php
namespace joem\OgQuery;

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
     *
     * Call $this::search, which will return results, ending
     * the chain.
     * @return array result of $this::search.
     */
    public function execute() {
        $response = $this->HttpClient->request('GET', $this->getEndpoint());

        $this->setResponseContent($response->getContent());
        return $this->search();
    }

    /**
     * Search the document for specified meta tags, this is the last
     * stop in the chain - or should be.
     *
     * - Create DOMDocument
     * - Load result
     * - Loop meta
     * - - If meta property is in array of els to return, match it.
     * - return matches.
     *
     * NOTE: this only searches for meta elements which are name or property.
     *
     * @return array
     */
    private function search() {

        $matches = [];
        $Dom = new DOMDocument();
        $Dom->loadHTML($this->responseContent);

        foreach ($Dom->getElementsByTagName('meta') as $tag) {
            $current_tag = $tag->getAttribute('property');
            (empty($current_tag) ? $current_tag = $tag->getAttribute('name') : '');

            $should_return_this_tag  = in_array($current_tag, $this->metaTagsToReturn);

            if ($should_return_this_tag) {
                $matches[$current_tag] = $tag->getAttribute('content');
            }
        }

        return json_encode($matches);
    }

    /**
     * Set a list of meta tags to return from the request.
     * Identifier must be a name or property value.
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