<header>
	<!--<img id="een" src="images/ic_search.svg" alt="vergrootglas_icon">-->
	<img id="twee" src="images/ic_live.svg" alt="livefeed_icon">
	<img id="drie" src="images/ic_notifications.svg" alt="notification_icon">
    <?php if($melding->countAllNew() > 0) :?>
        <p class="nummer"><?php echo $melding->countAllNew(); ?></span>
    <?php endif; ?>
	<h1><?php echo SCHERM; ?></h1>
	<div class="menuicon"><span></span></div>
	<div class="menu"></div>
	<div class="shade"></div>
	<?php
        $res2 = $melding->printAll($_SESSION["user"]);
    ?>
    <div id="meldingen">
        <ul>
            <?php foreach ( $res2 as $key => $boodschap): ?>
                <li class="melding">
                   <a class="pad" href="<?php echo $boodschap["pad"]; ?>">
                        <p class="boodschap"><?php echo $boodschap["boodschap"]; ?></p>
                        <p class="melding_id"><?php echo $boodschap["id"]; ?></p>
                    </a>
                    <a href="#" class="melding_close">x</a>
                </li>
            <?php endforeach; ?>
        </ul>
	</div>
</header>
