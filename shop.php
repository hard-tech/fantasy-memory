<?php
require "utils/common.php";
$page = "shop";
?>

<!DOCTYPE html>
<html lang="fr">
<?php include('partials/head.php'); ?>


<body>
<?php include('partials/header.php'); ?>


    <main>
        <section class="banner">
            <h1>Shop</h1>
        </section>

        <form action="" id="filter">
            <label for="itemType-select"></label>

            <select name="itemType" id="itemType-select">
              <option value="">--choose type item--</option>
              <option value="aura">Aura</option>
              <option value="power">Power</option>
              <option value="background">Background</option>
            </select>
                        
            <button>
                <span class="material-symbols-outlined">
                    search
                    </span>
            </button>
        </form>

        <section id="list-item-Shop">
            <section>
                <article>
                    <div class="aura-purple-items"></div>
                    <h3>aura purple</h3>
                    <p>100 coin</p> <button>Buy</button>
                </article>
                <article>
                    <div class="aura-purple-items"></div>
                    <h3>aura purple</h3>
                    <p>100 coin</p> <button>Buy</button>
                </article>
                <article>
                    <div class="aura-purple-items"></div>
                    <h3>aura purple</h3>
                    <p>100 coin</p> <button>Buy</button>
                </article>
            </section>
        </section>
    </main>
    
    <?php include('partials/footer.php'); ?>

</body>

</html>