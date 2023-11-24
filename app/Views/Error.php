<?= $this->extend('layouts/template.php'); ?>

<?= $this->section('content'); ?>
<div class="error">
    <div class="error__content">
        <h2>500</h2>
        <h3>Something went wrong!</h3>
        <p>There was a problem on our end. Please try again later.</p>
        <button type="button" class="btn btn-accent btn-pill" onclick="window.history.back()">&larr; Go Back</button>
    </div>
    <!-- / .error_content -->
</div>
<?= $this->endSection(); ?>