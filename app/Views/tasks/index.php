<?= $this->include('templates/header') ?>

<section class="page-heading">
    <div>
        <p class="eyebrow">Complete Schedule</p>
        <h2>Task List</h2>
        <p>All tasks ordered according to their scheduled date.</p>
    </div>
</section>

<section class="card">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task Title</th>
                    <th>Status</th>
                    <th>Task Date</th>
                    <th>Date Created</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= esc($task['id']) ?></td>
                        <td><?= esc($task['title']) ?></td>

                        <td>
                            <span
                                class="status <?= esc($task['status']) ?>"
                            >
                                <?= esc(ucfirst($task['status'])) ?>
                            </span>
                        </td>

                        <td>
                            <?= esc(date(
                                'F j, Y',
                                strtotime($task['task_date'])
                            )) ?>
                        </td>

                        <td>
                            <?= esc(date(
                                'F j, Y g:i A',
                                strtotime($task['created_at'])
                            )) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->include('templates/footer') ?>