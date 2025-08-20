# MiniNotes — Pure PHP MVC (PSR-4)

Kleine Notizen-App als Lernprojekt: **MVC + DDD-light + DIP** mit austauschbarer Datenquelle (**Session / CSV / PDO**) und **TDD** (PHPUnit).

## Highlights
- Core: `Request`, `Response`, `Router` (404-Hook)
- Kernel (Composition Root): verdrahtet Routen & Implementierungen
- HTTP: BaseController + Controller + Views (mit `htmlspecialchars`)
- Domain: Entities, Repo-Interfaces · Application: Services/DTOs
- Infrastructure: `InMemory`, `CsvNoteRepository`, `PdoNoteRepository`
- Routen: `GET /` · `GET /health` · `GET /notes` · `GET /notes/create` · `POST /notes` · `POST /notes/delete`

## Quickstart
```bash
composer install
php -S localhost:8000 -t public
# Browser: http://localhost:8000