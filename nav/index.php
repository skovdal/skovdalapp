<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredStart.php';
?><nav>
	<div class="nav">
		<ul>
			<li><a href="/systemUsers/index.php">Idea Management System (IMS)</a></li>
			<li><a href="/systemUsers/index.php">Systembrugere</a></li>
			<li><a href="/systemConfiguration/index.php">Systemkonfiguration</a></li>
			<li><a href="/systemStorages/index.php">Systemlagre</a></li>
			<li><a href="/systemNotifications/index.php">Systemnotifikationer</a></li>
			<li><a href="/systemEvents/index.php">Systemhændelser</a></li>
			<li><a href="/meetings/index.php">Møder</a></li>
			<li><a href="/users/index.php">Brugere</a></li>
			<li><a href="/devices/index.php">Enheder</a></li>
			<li><a href="/identities/index.php">Identiteter</a></li>
			<li><a href="/files/index.php">Filer</a></li>
			<li><a href="/fileShares/index.php">Fildelinger</a></li>
			<li><a href="/emailProcedures/index.php">E-mailprocedurer</a></li>
			<li><a href="/information/index.php">Oplysningspligt</a></li>
			<li><a href="/consents/index.php">Samtykker</a></li>
			<li><a href="/processingActivities/index.php">Behandlingsaktiviteter</a></li>
			<li><a href="/roles/index.php">Roller</a></li>
			<li><a href="/privileges/index.php">Rettigheder</a></li>
			<li><a href="/documents/index.php">Dokumenter</a></li>
			<li><a href="" onclick="">Stamdata</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Datasubjekter</a></li>
			</ul>
			<li><a href="" onclick="">Databeskyttelsesforordningen og databeskyttelsesloven</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/seedling.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Awareness</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/heart-rate.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/gdpr/processingActivities/index.php">Behandlingsaktiviteter</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/bone-break.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Brud</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/arrows-alt.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Dataansvar</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/books.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Dokumentation</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/traffic-cone.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Konsekvensanalyser</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/bars.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Logbog</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/info.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Oplysningspligt</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/book.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Politikker</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/book-alt.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Procedurer</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/key.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Rettigheder</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/balance-scale-right.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Risikoanalyser</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/check-circle.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Samtykker</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/eye.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Tilsyn</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/graduation-cap.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Uddannelse</a></li>
			</ul>
			<li><a href="" onclick="">ISO/IEC 19770-1 IT-aktiver</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Hardware</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Software/licencer</a></li>
			</ul>
			<li><a href="" onclick="">ISO/IEC 27001 Informationssikkerhed</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Dokumentation</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Politikker</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Procedurer</a></li>
			</ul>
			<li><a href="" onclick="">ISO/IEC 29134 Konsekvensvurderinger</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Konsekvensvurderinger</a></li>
			</ul>
			<li><a href="" onclick="">HR</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Jobansøgninger</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Medarbejdere</a></li>
			</ul>
			<li><a href="" onclick="">Domænenavne</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">DMARC-rapporter</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Domænenavne</a></li>
			</ul>
			<li><a href="" onclick="">Funktioner</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Dele dokumenter (sikkert/krypteret)</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Straffeattester</a></li>
			</ul>
			<li><a href="" onclick="">Compliance Center</a></li>
			<ul>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Brugere</a></li>
				<li style="background-image:url('/images/svgImage.php?id=<?php echo urlencode('/images/fontawesome-pro-5.9.0-web/svgs/light/users.svg'); ?>&fill=<?php echo urlencode('rgba(255,255,255,1)'); ?>');"><a href="/basedata/dataSubjects/index.php">Roller</a></li>
			</ul>
		</ul>
	</div>
</nav><?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/shared/required/requiredEnd.php';
?>