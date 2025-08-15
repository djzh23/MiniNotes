<link rel="stylesheet" href="/style.css">
<main class="container">
    <a class="btn" href="/notes/create">+ Create</a>
    <h1 class="mt1">Notes</h1>
    <ul>
        <?php foreach (($notes ?? []) as $n): ?>
            <li>
                <?= htmlspecialchars($n->title, ENT_QUOTES, 'UTF-8') ?>
                <form method="post" action="/notes/delete" style="display:inline">
                    <input type="hidden" name="id" value="<?= (int)$n->id ?>">
                    <button class="btn danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </li>
            <!-- <div>
                <li><?= htmlspecialchars($n->title, ENT_QUOTES, 'UTF-8') ?></li>
                <div class="actions">
                    <a class="btn" href="/notes/delete">Remove</a>
                </div>
            </div> -->
        <?php endforeach; ?>
    </ul>
</main>