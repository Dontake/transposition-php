<?php

declare(strict_types=1);

namespace Dondake\MusicTransposition\Console\Commands;

use Dondake\MusicTransposition\Enums\Storage\FileTypeEnum;
use Dondake\MusicTransposition\Exceptions\Storage\StorageException;
use Dondake\MusicTransposition\Exceptions\Console\ConsoleException;
use Dondake\MusicTransposition\Helpers\Str;
use Dondake\MusicTransposition\Mappers\NoteMapper;
use Dondake\MusicTransposition\Services\Storage\StorageService;
use Dondake\MusicTransposition\Services\Transposition\TranspositionServiceInterface;
use Dondake\MusicTransposition\Validators\Note\NoteInputValidator;

class SemitoneTranspositionCommand extends AbstractConsoleCommand
{
    public function __construct(
        public string $notesFilePath,
        public string $semitone,
        public TranspositionServiceInterface $service
    ) {}

    /**
     * @inheritDoc
     */
    public function run(): void
    {
        $semitone = (int) Str::getFromConsole($this->semitone);
        $notes = $this->getNotes(Str::getFromConsole($this->notesFilePath));

        (new NoteInputValidator(['notes' => $notes, 'semitone' => $semitone]))->run();

        StorageService::store(
            json_encode($this->service->run(NoteMapper::map($notes), $semitone), JSON_UNESCAPED_UNICODE),
            Str::getFilename('notes', FileTypeEnum::Json)
        );

        $this->logSuccess();
    }

    /**
     * @throws ConsoleException
     * @throws StorageException
     */
    protected function getNotes(string $notesFilePath)
    {
        if (!str_contains($notesFilePath, '.json')) {
            throw new ConsoleException('Available only json file extension for Notes transposition!');
        }

        return json_decode(StorageService::get($notesFilePath));
    }
}