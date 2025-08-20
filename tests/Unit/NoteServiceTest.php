<?php

use PHPUnit\Framework\MockObject\MockObject;
use App\Application\Note\NoteService;
use App\Domain\Note\Contracts\INoteRepository;
use App\Domain\Note\Note;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

// RUN : composer test -- --testdox
final class NoteServiceTest extends TestCase
{
    // Union-Typing (Workaround für Intelephense)
    /** @var MockObject&INoteRepository */
    private MockObject|INoteRepository $repo;

    private NoteService $service;

    protected function setUp(): void
    {
        $this->repo = $this->createMock(INoteRepository::class);
        $this->service = new NoteService($this->repo);
    }

    // Total Assertions = 15


    // TEST LIST NOTES ----------
    // Assertions = 2
    public function test_list_empty(): void
    {

        //Arrange : Mock konfigurieren ( method(...)->wilReturn(...)) 
        $this->repo->expects($this->once())
            ->method('all')
            ->willReturn([]);

        // Act : Service Methode aufrufen
        $dtos = $this->service->list();

        // Assert exakte Erwartung prüfen ( assertSame )
        $this->assertSame([], $dtos);
    }



    // TEST CREATE ----------
    // Assertions : 3 * 3 = 9
    #[DataProvider('createCases')]
    public function test_create_cases(int $newId, string $title)
    {
        // Arrange
        $this->repo->expects($this->once())
            ->method('create')
            ->willReturn(new Note($newId, $title, 'body'));

        // Act
        $dto = $this->service->create($title, 'body');

        // Assert
        $this->assertSame($newId, $dto->id);
        $this->assertSame($title, $dto->title);
    }

    public static function createCases(): array
    {
        // return [[1, 'a'], [7, 'Hello'], [15, 'ÄÜÖ']];
        return [
            'ascii title'  => [1, 'Hello'],
            'umlaute'      => [7, 'ÄÜÖ'],
            'longish'      => [15, str_repeat('X', 80)],
        ];
    }

    // TEST DELETE ----------
    // Assertions = 2 * 2 = 4
    #[DataProvider('deleteCases')]
    public function test_delete_case(int $id, bool $repoResult): void
    {
        // Arrange
        $this->repo->expects($this->once())
            ->method('delete')->with($this->equalTo($id))
            ->willReturn($repoResult);

        // Act
        $ok = $this->service->delete($id);

        // Assert
        $this->assertSame($repoResult, $ok);
    }

    public static function deleteCases(): array
    {
        // return [[42, true], [999, false]];
        return [
            'existing id' => [42, true],
            'missing id'  => [999, false],
        ];
    }


    // public function test_create_assigns_id_and_maps_to_dto(): void
    // {

    //     // $this->expectNotToPerformAssertions();
    //     // Arrange
    //     $this->repo->expects($this->once())
    //         ->method('create')
    //         ->willReturn(new Note(1, 'T', 'B'));

    //     // Act
    //     $noteDto = $this->service->create('T', 'B');

    //     // Assert
    //     $this->assertSame('T', $noteDto->title);
    //     // $this->assertSame('B', $note->body); // NoteDto hat kein body.
    //     $this->assertSame(1, $noteDto->id);
    // }

    // public function test_delete_note_by_existed_id_returns_true(): void
    // {
    //     // Arrange
    //     $id = 42;
    //     $this->repo->expects($this->once())
    //         ->method('delete') // hier soll ich auch vielleicht $id mit geben, da delete braucht ein argument?
    //         ->willReturn(true);


    //     // Act
    //     $isRemoved = $this->service->delete($id);

    //     // Assert
    //     // new count von list off notes reduced by -1 newcount = count-1
    //     $this->assertSame(true, $isRemoved);
    // }

    // public function test_delete_with_id_not_found_return_false()
    // {
    //     // Arrange
    //     // $id = 99999;
    //     $this->repo->expects($this->once())
    //         ->method('delete')
    //         ->with($this->equalTo(99999))
    //         ->willReturn(false);

    //     // Act
    //     $isRemoved = $this->service->delete(99999);

    //     // Assert
    //     $this->assertSame(false, $isRemoved);
    // }
}
