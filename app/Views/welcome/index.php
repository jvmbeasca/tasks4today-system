<?= $this->include('templates/header') ?>

<section class="page-heading">
    <div>
        <p class="eyebrow">Daily Dashboard</p>
        <h2>Welcome</h2>
        <p>Tasks scheduled for <?= esc($currentDate) ?></p>
    </div>

    <a class="button" href="<?= base_url('tasks') ?>">
        View All Tasks
    </a>
</section>

<section class="task-grid">
    <?php if (! empty($tasks)): ?>
        <?php foreach ($tasks as $task): ?>
            <article class="task-card">
                <div class="task-card-top">
                    <span class="task-id">
                        Task #<?= esc($task['id']) ?>
                    </span>

                    <span
                        class="status <?= esc($task['status']) ?>"
                    >
                        <?= esc(ucfirst($task['status'])) ?>
                    </span>
                </div>

                <h3><?= esc($task['title']) ?></h3>

                <p>
                    Scheduled for
                    <?= esc(date(
                        'F j, Y',
                        strtotime($task['task_date'])
                    )) ?>
                </p>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-message">
            <h3>No tasks scheduled today</h3>
            <p>There are currently no tasks for this date.</p>
        </div>
    <?php endif; ?>
</section>

<?= $this->include('templates/footer') ?>