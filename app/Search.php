<?php

namespace App;

class Search
{
    /**
     * @param $fileName
     * @return int|string
     * @deprecated
     */
    public function get($fileName)
    {
        $query = $_GET['query'];
        $return = sprintf('<p>Search results for query: %s.</p>', $query);

        if ($this->getFileExtension($fileName) != 'txt') {
            return 1;
        }

        try {
            $matches = $this->getSearchResults($fileName, $query);
        } catch (\Exception $e) {
            return 2;
        }

        $matches = array_map([$this, 'wrapLine'], $matches);

        return $return . implode('', $matches);
    }

    /**
     * @param string $filePath
     * @param string $query
     * @return array
     * @throws \Exception
     */
    public function getSearchResults(string $filePath, string $query)
    {
        $matches = [];
        foreach ($this->getLines($filePath) as $line) {
            preg_match(
                sprintf('/^%s => (.*)$/', $query),
                $line,
                $match
            );
            if (count($match)) {
                $matches[] = $match[1];
            }
        }
        return $matches;
    }

    /**
     * @param $fileName
     * @return string
     */
    private function getFileExtension($fileName): string
    {
        $pieces = explode('.', $fileName);
        $extension = array_pop($pieces);
        return $extension;
    }

    /**
     * @param string $filePath
     * @return \Generator
     * @throws \Exception
     */
    private function getLines(string $filePath)
    {
        $file = @fopen($filePath, 'r');
        if (!$file) {
            throw new \Exception('File does not exist or cannot be opened.');
        }

        while (($line = fgets($file)) != false) {
            yield $line;
        }

        fclose($file);
    }

    /**
     * @param $line
     * @return string
     */
    private function wrapLine($line)
    {
        return '<p>' . $line . '</p>';
    }
}
