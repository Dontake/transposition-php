<?php

declare(strict_types=1);

namespace Dondake\Tests\Unit\Services\Transposition;

use Dondake\MusicTransposition\Exceptions\Transposition\TranspositionException;
use Dondake\MusicTransposition\Mappers\NoteMapper;
use Dondake\MusicTransposition\Services\Transposition\NoteTranspositionService;
use PHPUnit\Framework\TestCase;

final class NoteTranspositionTest extends TestCase
{
    protected NoteTranspositionService $service;

    protected array $input = [
        [2, 1], [2, 6], [2, 1], [2, 8], [2, 1], [2, 9], [2, 1], [2, 6], [2, 1], [2, 8], [2, 1], [2, 9], [2, 1], [2, 11],
        [2, 1], [2, 8], [2, 1], [2, 9], [2, 1], [2, 11], [2, 1], [3, 1], [2, 1], [2, 9], [2, 1], [2, 11], [2, 1],
        [3, 1], [2, 1], [3, 2], [2, 1], [2, 11], [2, 1], [3, 1], [2, 1], [2, 9], [2, 1], [2, 11], [2, 1], [2, 8],
        [2, 1], [2, 9], [2, 1], [2, 6], [2, 1], [2, 8], [2, 1], [2, 5], [2, 1], [2, 6], [2, 1], [2, 1], [2, 1], [2, 2],
        [2, 1], [1, 11], [2, 1], [2, 1], [2, 1], [1, 9], [2, 1], [1, 11], [2, 1], [1, 8], [2, 1], [1, 9], [2, 1], [1, 6],
        [2, 1], [1, 11], [2, 1], [1, 8], [2, 1], [1, 9], [2, 1], [1, 6], [2, 1], [1, 8], [2, 1], [1, 5], [2, 1], [1, 6]
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new NoteTranspositionService();
    }

    public function testOk()
    {
        $output = [
            [1, 10], [2, 3], [1, 10], [2, 5], [1, 10], [2, 6], [1, 10], [2, 3], [1, 10], [2, 5], [1, 10], [2, 6],
            [1, 10], [2, 8], [1, 10], [2, 5], [1, 10], [2, 6], [1, 10], [2, 8], [1, 10], [2, 10], [1, 10], [2, 6],
            [1, 10], [2, 8], [1, 10], [2, 10], [1, 10], [2, 11], [1, 10], [2, 8], [1, 10], [2, 10], [1, 10], [2, 6],
            [1, 10], [2, 8], [1, 10], [2, 5], [1, 10], [2, 6], [1, 10], [2, 3], [1, 10], [2, 5], [1, 10], [2, 2],
            [1, 10], [2, 3], [1, 10], [1, 10], [1, 10], [1, 11], [1, 10], [1, 8], [1, 10], [1, 10], [1, 10], [1, 6],
            [1, 10], [1, 8], [1, 10], [1, 5], [1, 10], [1, 6], [1, 10], [1, 3], [1, 10], [1, 8], [1, 10], [1, 5],
            [1, 10], [1, 6], [1, 10], [1, 3], [1, 10], [1, 5], [1, 10], [1, 2], [1, 10], [1, 3]
        ];

        $this->assertEquals($this->service->run(NoteMapper::map($this->input), -3), $output);
    }

    public function testOutOfRangeError()
    {
        $this->expectException(TranspositionException::class);
        $this->expectExceptionMessage('Octave number out from available range!');
        $this->service->run(NoteMapper::map($this->input), 36);
    }

    public function testDecrease()
    {
        $this->assertEquals([[-4, 12]], $this->service->run(NoteMapper::map([[0, 1]]), -37));
    }

    public function testIncrease()
    {
        $this->assertEquals([[2, 7]], $this->service->run(NoteMapper::map([[0, 1]]), 30));
    }
}