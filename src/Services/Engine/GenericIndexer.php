<?php

namespace Betalabs\LaravelHelper\Services\Engine;


class GenericIndexer extends AbstractIndexer
{
    /**
     * Retrieve a resource on engine
     *
     * @return mixed
     */
    public function index()
    {
        return $this->engineResourceIndexer->setQuery($this->query)
            ->setEndpoint($this->endpoint)
            ->setEndpointParameters($this->endpointParameters)
            ->setLimit($this->limit)
            ->setOffset($this->offset)
            ->setExceptionMessage(
                trans(
                    $this->exceptionTranslationPath . '.' . $this->endpoint . '.retrieve'
                )
            )
            ->retrieve();
    }
}