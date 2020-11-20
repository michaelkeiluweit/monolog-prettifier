<?php declare(strict_types=1);

namespace MichaelKeiluweit\MonologPrettifier\Model\Log;


/**
 * Class Collection
 */
class Repository
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

            preg_match(self::$pattern, $line, $matches);

            if (empty($matches)) {
                continue;
            }

            $collection[] = new Entity($matches);
        }

        return $collection;
    }
}
