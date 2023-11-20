# Music Transposition
Library for music transposition from JSON format

### Usage
<br>

#### From console
````
composer cli semitone-transposition path=/home/transposition-php/public/example.json semitone=-3
````
You must specify the full path to the file
<br>

#### From your app
````
use Dondake\MusicTransposition\Mappers\NoteMapper;
use Dondake\MusicTransposition\Services\Transposition\NoteTranspositionService;

$input = [[2, 3], [4, 10]]; // [$octaveNumber, $noteNumber]
$semiton = -3;

$service = new NoteTranspositionService();

return $service->run(NoteMapper::map($input), $semiton);
````

#### Run tests
````
composer test
````