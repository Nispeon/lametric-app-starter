<?php

declare(strict_types=1);

use LaMetric\Field;
use LaMetric\Validator;
use LaMetric\Exception\{InvalidArgumentException, MissingArgumentException};
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @var array
     */
    private $parameters;

    public function setUp(): void
    {
        $this->parameters = include_once __DIR__ . '/config/fields.php';
    }

    public function testMissingTextParameter(): void
    {
        $this->expectException(MissingArgumentException::class);

        $httpGetData = [];

        $validator = new Validator($httpGetData);
        $validator->check($this->parameters);
    }

    public function testInvalidTextParameter(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $httpGetData = [
            'field-1' => ''
        ];

        $validator = new Validator($httpGetData);
        $validator->check([
            [
                'key'  => 'field-1',
                'type' => Field::TEXT_TYPE
            ]
        ]);
    }

    public function testInvalidNumberParameter(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $httpGetData = [
            'field-1' => 'number'
        ];

        $validator = new Validator($httpGetData);
        $validator->check([
            [
                'key'  => 'field-1',
                'type' => Field::NUMBER_TYPE
            ]
        ]);
    }

    public function testInvalidSwitchParameter(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $httpGetData = [
            'field-1' => 'number'
        ];

        $validator = new Validator($httpGetData);
        $validator->check([
            [
                'key'  => 'field-1',
                'type' => Field::SWITCH_TYPE
            ]
        ]);
    }

    public function testInvalidChoicesParameter(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $httpGetData = [
            'field-1' => 'no'
        ];

        $validator = new Validator($httpGetData);
        $validator->check([
            [
                'key'     => 'field-1',
                'type'    => Field::CHOICES_TYPE,
                'choices' => [
                    'yes',
                    'ya',
                    'da',
                    'oui'
                ]
            ]
        ]);
    }
}
