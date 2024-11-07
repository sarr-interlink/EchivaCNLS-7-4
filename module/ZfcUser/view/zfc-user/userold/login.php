<?php echo $this->doctype(); ?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php
        echo $this->headTitle('Amnir Echiva')->setSeparator(' - ')->setAutoEscape(false);

        echo $this->headMeta()
                ->appendName('viewport', 'width=device-width, initial-scale=1.0')
                ->appendHttpEquiv('X-UA-Compatible', 'IE=edge');
        ?>
        <!-- Icon -->
        <link rel="icon" href="themes/datas/images/icon.ico" />
        <?php
        echo $this->headLink()
                ->prependStylesheet($this->basePath('viaphotoshop/1_echiva.css'))
				->prependStylesheet($this->basePath('viaphotoshop/layout_login2.min.css'))
        ?>

    </head>
    <body class="hold-transition skin-blue-light sidebar-mini"> 
        <!-- pre load icon -->	
        <div class="se-pre-cono"></div>
        <!-- /pre load icon -->
        <div class="wrapper">
            <div class="wrapper" id="wrapper">
                <div class="header">
					<div class="Objet_dynamique_vectoriel1">
					</div>
					<div class="Le_suivi_medicale_parfait_des_dossiers_des_pati">
						<b>Le suivi medicale parfait</b><br>
						<font color="#ffffff">des dossiers des patients</font>
					</div>
				</div>
                <div class="content">
					<div class="jumbotron_lg">  <br />

                        <!-- start  entete's form login-->
                        <div class="form-place">
                            <div class="tabs-top">
                                <span class="log-tabs active" data-id="regForm">Connectez-vous</span>
                            </div>     
                            <div class="form_wrappers">
                                <!-- start form login -->
                                <?php
                                $form = $this->loginForm;
                                $form->prepare();
                                $form->setAttribute('action', $this->url('zfcuser/login'));
                                $form->setAttribute('method', 'post');
                                $form->setAttribute('autocomplete', 'off');
                                echo $this->partial('_form.phtml', ['form' => $form]);
                                ?>
                                <!-- end form login -->
                                <!-- / container -->
                            </div>

                        </div> 
                    </div>
				
				
				
			<!--		<div class="Objet_dynamique_vectoriel6">
					</div>
					<span class="Bienvenue_sur_votre_plateforme__de_gestion_et_s" data-id="regForm">Bienvenue sur votre plateforme<br>de gestion et suivi medical</span>
				</div>
				<div class="Rectangle_4">
				<div class="Objet_dynamique_vectoriel2"></div>
				<div class="Objet_dynamique_vectoriel"></div>
				</div>-->
			</div>
            <?php echo $this->inlineScript() ?>
        </div>

    </body>
</body>
</html>