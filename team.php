<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['like'])) {
        $profile = $_POST['profile'];

        if (!isset($_COOKIE[$profile])) {
            setcookie($profile, 1, time() + (86400 * 30), "/"); 
            $_SESSION['liked'][$profile] = true; 
        } else {
            setcookie($profile, ++$_COOKIE[$profile], time() + (86400 * 30), "/");
            $_SESSION['liked'][$profile] = true;
        }
    }
}

$filter = '';
if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
}

$title = 'Our Team';
include './view/header.php';
?>

<form method="POST" action="" class="box-form-search">
        <input type="text" name="filter" class="searchbar" placeholder="Search team member..." value="<?= htmlspecialchars($filter) ?>">           
</form>


<div class="team">
    <?php

    $teamMembers = [
        [
            'name' => 'Reiselle Anne S. Mercader',
            'info' => 'Web Developer',
            'img' => 'img/rei2-removebg-preview.png',
            'profile' => 'rei',
            'github' => 'https://github.com/Rei-selle'
        ],
        [
            'name' => 'Melody L. Marto',
            'info' => 'Web Developer',
            'img' => 'img/loding-removebg-preview.png',
            'profile' => 'mel',
            'github' => 'https://github.com/Loding13'
        ],
        [
            'name' => 'Charles N. Arabia',
            'info' => 'Web Manager',
            'img' => 'img/charles-removebg-preview.png',
            'profile' => 'charles',
            'github' => 'https://github.com/Automata01'
        ],
        [
            'name' => 'Joana Marie L. De Leon',
            'info' => 'Web Desinger',
            'img' => 'img/joana__1_-removebg-preview.png',
            'profile' => 'joana',
            'github' => 'https://github.com/Joana-24'
        ],
        [
            'name' => 'Jonabelle Aruta',
            'info' => 'Web Content Creator',
            'img' => 'img/Apurillo-removebg-preview.png',
            'profile' => 'jonabelle',
            'github' => 'https://github.com/Belle0125'
        ],
        [
            'name' => 'Carla Cinarillos',
            'info' => 'Web Planner',
            'img' => 'img/carlac.png',
            'profile' => 'jonabelle',
            'github' => 'https://github.com/Belle0125'
        ],
    ];

    foreach ($teamMembers as $member) {
        if (empty($filter) || stripos($member['name'], $filter) !== false) {
            $likeCount = isset($_COOKIE[$member['profile']]) ? $_COOKIE[$member['profile']] : 0;
            ?>
            <div class="team-container">
                <div class="profile">
                    <img src="<?= $member['img'] ?>" alt="Profile Image" class="profile-img">
                </div>
                <p class="profile-name"><?= $member['name'] ?></p>
                <div class="profile-info"><?= $member['info'] ?></div>
                <div class="socmed">
                    <a href="<?= $member['github'] ?>"><i class="fa fa-github" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                    <form method="POST" action="" style="display: inline;">
                        <input type="hidden" name="profile" value="<?= $member['profile'] ?>">
                        <button type="submit" name="like" id="heart" <?= isset($_SESSION['liked'][$member['profile']]) ? 'disabled' : '' ?>>
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <span class="like-count"><?= $likeCount ?></span>
                        </button>
                    </form>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
<script>
    document.querySelectorAll('button[name="like"]').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const formData = new FormData();
            formData.append('profile', this.previousElementSibling.value);
            formData.append('like', true);

            fetch("", {
                method: "POST",
                body: formData
            }).then(response => response.text())
            .then(data => {
                const countSpan = this.querySelector('.like-count');
                countSpan.textContent = parseInt(countSpan.textContent) + 1;
                this.setAttribute('disabled', true);
            });
        });
    });
</script>

<?php include './view/footer.php'; ?>
