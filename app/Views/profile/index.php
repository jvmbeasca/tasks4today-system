<?= $this->include('templates/header') ?>

<section class="page-heading">
    <div>
        <p class="eyebrow">Demo Account</p>
        <h2>User Profile</h2>
        <p>Information about the system's demonstration user.</p>
    </div>
</section>

<?php if ($user !== null): ?>
    <section class="profile-card">
        <div class="profile-avatar">
            <?= esc(strtoupper(substr($user['full_name'], 0, 1))) ?>
        </div>

        <div class="profile-details">
            <h3><?= esc($user['full_name']) ?></h3>

            <dl>
                <div>
                    <dt>Username</dt>
                    <dd><?= esc($user['username']) ?></dd>
                </div>

                <div>
                    <dt>Email</dt>
                    <dd><?= esc($user['email']) ?></dd>
                </div>

                <div>
                    <dt>Member Since</dt>
                    <dd>
                        <?= esc(date(
                            'F j, Y',
                            strtotime($user['created_at'])
                        )) ?>
                    </dd>
                </div>
            </dl>
        </div>
    </section>
<?php else: ?>
    <section class="empty-message">
        <h3>No user record found</h3>
        <p>Add one demonstration user to the users table.</p>
    </section>
<?php endif; ?>

<?= $this->include('templates/footer') ?>