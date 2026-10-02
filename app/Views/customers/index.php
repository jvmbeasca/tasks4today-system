<section class="page-heading">
    <div>
        <p class="eyebrow">Customer directory</p>

        <h1>Customers</h1>

        <p>
            Manage customer names, email addresses,
            and phone numbers.
        </p>
    </div>

    <a
        class="button button-primary"
        href="<?= site_url('customers/new') ?>"
    >
        Add customer
    </a>
</section>

<div class="table-card">
    <div class="table-scroll">

        <table>
            <thead>
            <tr>
                <th>Full name</th>
                <th>Email address</th>
                <th>Phone number</th>
                <th>Date created</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            <?php if (empty($customers)): ?>

                <tr>
                    <td colspan="5" class="empty-message">
                        No customer records found.
                    </td>
                </tr>

            <?php else: ?>

                <?php foreach ($customers as $customer): ?>

                    <tr>
                        <td>
                            <strong>
                                <?= esc($customer['full_name']) ?>
                            </strong>
                        </td>

                        <td>
                            <?= esc($customer['email']) ?>
                        </td>

                        <td>
                            <?= esc(
                                $customer['phone']
                                ?: 'Not provided'
                            ) ?>
                        </td>

                        <td>
                            <?= esc(date(
                                'M j, Y',
                                strtotime($customer['created_at'])
                            )) ?>
                        </td>

                        <td>
                            <a
                                class="table-action"
                                href="<?= site_url(
                                    'customers/'
                                    . $customer['id']
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