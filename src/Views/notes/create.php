<link rel="stylesheet" href="/style.css">
<main class="container">
    <a class="btn" href="/notes">← Back</a>
    <h1 class="mt1">Create Note</h1>
    <form method="post" action="/notes" class="form">
        <div class="field">
            <label for="title">Title</label>
            <input id="title" name="title" required>
        </div>
        <div class="field">
            <label for="body">Body Note</label>
            <textarea id="body" name="body" rows="6"></textarea>
        </div>
        <div class="actions">
            <button class="btn primary" type="submit">Save</button>
            <a class="btn" href="/notes">Cancel</a>
        </div>
    </form>


</main>