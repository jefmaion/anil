<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <?php $this->load->view('template/parts/header') ?>
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- navbar -->
            <?php $this->load->view('template/parts/navbar') ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        <?= $contents ?>
                    </div>
                </section>
            </div>
            <?php $this->load->view('template/parts/footer') ?>
        </div>
    </div>
    <?php $this->load->view('template/parts/scripts') ?>
</body>
</html>