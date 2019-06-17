<?php
/**
 * Created by PhpStorm.
 * User: rougelotugo
 * Date: 2019-03-12
 * Time: 22:23
 */

?>

<!--<section class="content-header">
    <h1>
        <u>Liste des rencontres à arbitrer :</u>
    </h1>
</section>-->


<div class="container" id="app" style="margin-top: 30px">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>Liste des rencontres à arbitrer</b>
        </div>
        <div class="panel-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered table-striped">

                    <thead>
                    <tr>
                        <th>Equipe Domicile</th>
                        <th>Score Domicile</th>
                        <th>Score Exterieur</th>
                        <th>Equipe Exterieur</th>
                        <th>Date de la rencontre</th>
                        <th>Status</th>
                        <th>Page d'arbitrage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="rencontre in rencontres" :key="rencontre.id_rencontre">
                        <td>{{rencontre.equipe_dom}}</td>
                        <td>{{(rencontre.score_equipe_dom == null) ? 0 : rencontre.score_equipe_dom }}</td>
                        <td>{{(rencontre.score_equipe_ext == null) ? 0 : rencontre.score_equipe_ext }}</td>
                        <td>{{rencontre.equipe_ext}}</td>
                        <td>{{rencontre.date_rencontre}}</td>
                        <td v-if="rencontre.has_been_played == 1">
                            Rencontre déja faite !
                        </td>
                        <td v-else>
                            {{(rencontre.en_cours == 1) ? "Rencontre en cours" : "Rencontre à venir"}}
                        </td>
                        <td><a class="btn btn-success" v-bind:href="'<?= DIR . \Helpers\Url::URL_RENCONTRE . "/" ?>' + rencontre.id_rencontre">Go !</a></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


<script>
    var ajaxUrl = "<?= DIR . \Helpers\Url::URL_DASHBOARD_AJAX ?>";
</script>
