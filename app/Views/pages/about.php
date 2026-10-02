<?= $this->include('templates/header') ?>

<section class="page-heading">
    <div>
        <p class="eyebrow">System Information</p>
        <h2>About</h2>
        <p>Information about the project and its developer.</p>
    </div>
</section>

<section class="card about-content">
    <h3>Tasks for Today Management System</h3>

    <p>
        Tasks for Today is a CodeIgniter 4 application designed to
        help a team monitor its daily and upcoming responsibilities.
    </p>

    <p>
        The Welcome page displays tasks scheduled for the current
        date, while the Task List page displays every stored task.
    </p>

    <h3>Developer</h3>

    <p>
        This system was developed by
        <strong>John Vincent Beasca</strong>
        as a Technical Summative Assessment for IT0049 Web System
        Technologies.
    </p>
</section>

<?= $this->include('templates/footer') ?>