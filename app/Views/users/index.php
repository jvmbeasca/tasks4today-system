<section class="page-heading">
    <div>
        <p class="eyebrow">Staff directory</p>

        <h1>Users</h1>

        <p>Manage usernames, staff names, and profile avatars.</p>
    </div>

    <a
        class="button button-primary"
        href="<?= site_url('users/new') ?>"
    >
        Add user
    </a>
</section>

<div class="table-card">
    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Full name</th>
                    <th>Date created</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="empty-message">
                            No user records found.
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <?php if (! empty($user['avatar'])): ?>
                                    <img
                                        class="avatar"
                                        src="<?= base_url(
                                            'uploads/avatars/'
                                            . $user['avatar']
                                        ) ?>"
                                        alt="User avatar"
                                    >
                                <?php else: ?>
                                    <span class="avatar-placeholder">
                                        No image
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?= esc($user['username']) ?>
                            </td>

                            <td>
                                <strong>
                                    <?= esc($user['full_name']) ?>
                                </strong>
                            </td>

                            <td>
                                <?= esc(date(
                                    'M j, Y',
                                    strtotime($user['created_at'])
                                )) ?>
                            </td>

                            <td>
                                <a
                                    class="table-action"
                                    href="<?= site_url(
                                        'users/'
                                        . $user['id']
                                        . '/edit'
                                    ) ?>"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>