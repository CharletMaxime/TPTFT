<?php
$this->layout('template', ['title' => $title]);
?>
<div>
    <h1> <?= $h1 ?></h1>
    <?php if (!empty($message)): ?>
        <div class="errorMessage">
            <?= $message ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="<?= $action ?>" enctype="multipart/form-data">
        <div class="unitInfo">
            <label for="id"></label>
            <input type="text" id="id" name="id" value="<?= isset($origin) ? htmlspecialchars($origin->getId()) : '' ?>"
                   hidden="hidden">

            <label for="name">Nom :</label>
            <input type="text" value="<?= isset($origin) ? htmlspecialchars($origin->getName()) : '' ?>" name="name"
                   id="name" required>

            <label for="url_img">Emblème :</label>
            <?php if (isset($origin)): ?>
                <img class="portrait" src="<?= htmlspecialchars(\Config\Config::get('pathGrpPublicFolder'). '/img/characters/origins/' . $origin->getUrl_img())?>" alt="Image de l'origine">
            <?php endif; ?>
            <input type="file" name="url_img" id="url_img"
                <?= $imageRequired ? 'required' : '' ?>
                   accept=".png, .jpg, .jpeg, .svg">
        </div>
        <button type="submit"><?= $submitButton ?></button>
        <script src="/public/js/script.js">initFormValidation()</script>
    </form>
</div>