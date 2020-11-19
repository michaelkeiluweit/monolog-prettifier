<?php

namespace MichaelKeiluweit\MonologPrettifier\Model\Log;


/**
 * Class Collection
 */
class Collection
{
    private static string $pattern = '/\[(?P<date>.*)\] (?P<logger>[\w\ ]+\w+).(?P<level>\w+): (?P<message>[^\[\{]+) (?P<context>[\[\{].*[\]\}]) (?P<extra>[\[\{].*[\]\}])/';

    /** @return string[] */
    public function getContentAsArray(): array
    {
        return is_file(OX_LOG_FILE) ? file(OX_LOG_FILE) : [];
    }

    /**
     * Returns all lines with the default OXID pattern: $date OXID Logger.$level ...
     * @return Entity[]
     */
    public function getEntities(): array
    {
        $collection = [];

        foreach ($this->getContentAsArray() as $line) {

            preg_match(self::$pattern, $line, $matches); //@todo preg match all
            if (empty($matches)) {
                continue;
            }
            $collection[] = new Entity($matches);
        }

        return $collection;
    }
}
