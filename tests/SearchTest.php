<?php
namespace App\Tests;

class SearchTest extends \PHPUnit\Framework\TestCase
{
    /** @var \App\Search */
    private $search;

    public function setUp(): void
    {
        parent::setUp();
        $this->search = new \App\Search();
        $_GET = [];
    }

    public function getProvider()
    {
        return [
            's0: one txt result' => [
                'query' => 'test-query',
                'expected' => '<p>Search results for query: test-query.</p><p>test value</p>',
            ],
            's1: more txt result' => [
                'query' => 'another-query',
                'expected' => '<p>Search results for query: another-query.</p><p>value 2</p><p>value 3</p>',
            ],
        ];
    }

    /**
     * @dataProvider getProvider
     * @param $query
     * @param $expected
     */
    public function testGet($query, $expected)
    {
        $_GET['query'] = $query;
        $this->assertEquals($expected, $this->search->get('test.txt'));
    }

    public function testWrongExtension()
    {
        $_GET['query'] = "123";
        $this->assertEquals(1, $this->search->get('test.png'));
    }

    public function testFileNotExists()
    {
        $_GET['query'] = "123";
        $this->assertEquals(2, $this->search->get('tt.txt'));
    }
}