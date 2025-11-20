<?php

use PHPUnit\Framework\TestCase;

class FakeResult {
    private $rows;
    private $index = 0;
    public $num_rows;
    public function __construct(array $rows) {
        $this->rows = $rows;
        $this->num_rows = count($rows);
    }
    public function fetch_assoc() {
        if ($this->index < $this->num_rows) {
            return $this->rows[$this->index++];
        }
        return null;
    }
    public function free_result() {}
}

class FakeMysqli {
    private $data;
    public $error = '';
    public function __construct(array $data) {
        $this->data = $data;
    }
    public function query($sql) {
        return new FakeResult($this->data);
    }
    public function close() {}
}

define('PHPUNIT_TEST', true);

require_once __DIR__ . '/../functions.php';

class FunctionsTest extends TestCase {
    protected function setUp(): void {
        $GLOBALS['fakeData'] = [];
    }

    public function testExecutarConsultaMultiplaReturnsArray() {
        $GLOBALS['fakeData'] = [
            ['name' => 'John'],
            ['name' => 'Jane']
        ];
        $result = executarConsultaMultipla('SELECT * FROM users');
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertSame('John', $result[0]['name']);
    }

    public function testExecutarConsultaMultiplaReturnsEmptyArray() {
        $GLOBALS['fakeData'] = [];
        $result = executarConsultaMultipla('SELECT * FROM users WHERE 0');
        $this->assertIsArray($result);
        $this->assertCount(0, $result);
    }
}
